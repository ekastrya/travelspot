@extends('layouts.global')

@section('content')
<div class="site__hiw">
    <div class="site__hiw-header">
        <h1 class="site__hiw-header-title">Perbandingan Paket Wisata</h1>
        <div class="site__hiw-header-subtitle">Berikut adalah hasil perbangingan dari paket wisata yang Anda pilih</div>

        <div style="margin:0 auto;">
    			<div class="px-2 mb-1">
    				<div class="flex -mx-2 h-full">
                        <section
                          class="flex flex-col lg:flex-row items-start items-center lg:justify-center w-full w-full lg:px-10 py-1"
                        >
                          


                        @foreach(range(1,2) as $id)
                          @foreach($destinations as $dest)
                            @if( trim(html_entity_decode($dest['title'])) == trim(session('p'.$id)) )
                              <article
                              class="bg-white w-4/3 lg:w-custom mb-10 lg:px-4 px-6 py-10 text-center text-primary-dark rounded-lg"
                              >
                                <h5 class="font-bold text-base">{{ $dest['title'] }}</h5>
                                <h2 class="pb-4 flex justify-center font-bold border-b border-gray-300">
                                <span class="text-3xl mt-6 mr-1">Rp. </span
                                ><span class="text-6xl">{{ $dest['price'] }}</span><span class="text-3xl mt-6 mr-1"> &nbsp;jt</span
                                >
                                </h2>
                                <ul class="text-sm font-bold">
                                <li class="pt-4 pb-4 border-b border-gray-300">{{ str_replace('H',' Hari', explode(' ', $dest['title'])[0]) }}</li>
                                <li class="pt-3 pb-4 border-b border-gray-300">Hotel</li>
                                <li class="pt-3 pb-4 border-b border-gray-300">Breakfast</li>
                                </ul>
                                <button
                                  class=" uppercase text-center text-sm mt-12 xl:px-24 px-12 sm:px-16 py-2 font-bold text-primary-very-light rounded-md"
                                  style="background-image:linear-gradient(90deg, #a3a8f0 0%, #696fdd 100%);"
                                  >
                                  Pesan Sekarang
                                </button>
                              </article>
                              @break
                            @endif
                          @endforeach
                        @endforeach
                        </section>
    				</div>
    			</div>
        </div>
    </div>

</div>

                        <div class="h-full" style="width:300px; margin:0 auto;">
                          <div class="px-6 py-4">
                            <a href="{{ route('compare.clear') }}" class="w-full text-center inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Kosongkan Perbandingan</a>
                          </div>
                        </div>

@endsection

@section('headscript')
@endsection