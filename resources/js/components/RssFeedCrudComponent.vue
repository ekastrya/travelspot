<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-10">
                <div class="card">
                    <div class="card-header">{{ myAction }}RSS Feed</div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Channel/Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, index) in rssFeeds">
                                    <td>{{ index+1 }}</td>
                                    <td>
                                        {{ row.rss_channel_id }}:<br>
                                        {{ row.title }}
                                    </td>
                                    <td>{{ (row.status==1?"Aktif":"Tidak aktif") }}</td>
                                    <td>
                                        <a href="row.link">Visit</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
                rssFeeds: []
            }
        },
        mounted() {
            this.retrieveFeed('all');
        },
        methods: {
            retrieveFeed: function(id){
                let self = this
                axios.get('/api/rss-feed/' + id)
                    .then(function (response) {
                        self.rssFeeds = response.data
                    })
                    .catch(function (error) {
                        alert(error)
                    });
            }
        }
    }
</script>
