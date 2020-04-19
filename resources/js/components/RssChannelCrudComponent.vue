<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-10">
                <div class="card">
                    <div class="card-header">{{ myAction }}RSS Channel</div>

                    <div class="card-body">
                        <h3>Tambah Channel Baru</h3>
                        <div class="form-group">
                            <label for="theLink">URL / HyperLink</label>
                            <input type="text" class="form-control" id="theLink" aria-describedby="theLinkHelp" v-model="theLink">
                        </div>

                        <div class="form-group">
                            <label for="theTitle">Title</label>
                            <input type="text" class="form-control" id="theTitle" aria-describedby="theTitleHelp" v-model="theTitle">
                            <small id="theTitle" class="form-text text-muted">Tidak Wajib diisi.</small>
                        </div>

                        <div class="form-group">
                            <label for="theDescription">Description</label>
                            <textarea class="form-control" id="theDescription" aria-describedby="theDescriptionHelp" v-model="theDescription"></textarea>
                            <small id="theDescription" class="form-text text-muted">Tidak wajib diisi.</small>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                            <input class="form-check-input" type="radio" id="theStatus1" value="1" v-model="theStatus">
                            <label class="form-check-label" for="theStatus1">
                                Aktif
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" id="theStatus2" value="0" v-model="theStatus">
                            <label class="form-check-label" for="theStatus2">
                                Tidak aktif
                            </label>
                            </div>
                        </div>

                        <div class="flex">
                            <button class="btn btn-sm btn-primary flex-1" v-on:click="saveNewChannel()">Save</button>
                            <button class="btn btn-sm flex-1">Cancel</button>
                        </div>
                        <hr />
                        <h3>Channel Data</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>Description</th>
                                    <th>LBD<sup>*</sup></th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, index) in rssChannels">
                                    <td>{{ index+1 }}</td>
                                    <td>{{ row.title }}</td>
                                    <td>{{ row.link }}</td>
                                    <td>{{ row.description }}</td>
                                    <td>{{ row.last_build_date }}</td>
                                    <td>{{ (row.status==1?"Aktif":"Tidak aktif") }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" @click="deleteChannel($event, row.id)">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div><small>(*): Last Build Date</small></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                rssChannels: [],
                theTitle: "",
                theDescription: "",
                theLastBuildDate: "",
                theLink: "",
                theStatus: 1,
                myAction: ""
            }
        },
        mounted() {
            this.retrieveChannel(this.$event, 'all');
        },
        methods: {
            retrieveChannel: function(event, id){
                let self = this;
                axios.get('/api/rss-channel/' + id)
                    .then(function (response) {
                        self.rssChannels = response.data
                    })
                    .catch(function (error) {
                        alert(error)
                    });
            },
            saveNewChannel: function(event){
                axios.post('/api/rss-channel',
                    { last_build_date: this.theLastBuildData
                    , description: this.theDescription
                    , status: this.theStatus
                    , title: this.theTitle
                    , link: this.theLink
                    }
                )
                .then(function (response) {
                    alert(response.status)
                })
                .catch(function (error) {
                    alert(error.response.status)
                });
            },
            deleteChannel: function(event, id){
                let self = this;
                axios.post('/api/rss-channel/'+id, {"_method": "delete"})
                .then(function (response) {
                    self.retrieveChannel()
                })
                .catch(function (error) {
                    alert(error.response.status)
                })
            }
        }
    }
</script>
