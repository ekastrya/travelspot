<div class="snappr-section" id="photographers">
	<div class="snappr-container snappr-w-container">
		<h2 class="snappr-center snappr-new-section-heading">Destinasi Wisata <span class="snappr-new-section-heading-accent">terpopuler</span>.</h2>
		<p class="snappr-center snappr-new-section-description">Travelspot hanya menampilkan destinasi wisata dengan rating terbaik.</p>

		<!-- Four columns -->
			@foreach($destinations as $key => $dest)
				@if($key % 4 == 0)
				<div class="px-2 mb-8">
					<div class="flex -mx-2 h-full">
				@endif
						<div class="w-full w-md-1/4 px-2">
<div class="max-w-sm h-full rounded overflow-hidden shadow-lg">
  <img class="w-full" src="{!! $dest['image_url'] !!}" alt="Sunset in the mountains">
  <div class="px-6 py-4">
    <a href="{{ route('payment.checkout',['image'=>$dest['image_url'],'title'=>$dest['title'],'price'=>$dest['price']]) }}" class="w-full text-center inline-block bg-blue-900 rounded-full px-3 py-1 text-sm font-semibold text-gray-100 mr-2 mb-2">Pesan Sekarang</a>
    <a href="{{ route('compare.add',['title'=>$dest['title']]) }}" class="w-full text-center inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Bandingkan</a>
  </div>
  <div class="px-6 py-4">
    <p class="text-gray-700 text-base text-center">
      {{ $dest['price'] }}
    </p>
    <div class="font-bold text-xl mb-2 text-center">{{ $dest['title'] }}</div>
  </div>
</div>
						</div>
				@if($key % 4 == 3)
					</div>
				</div>
				@endif
			@endforeach

	</div>
</div>





<style>
	.putih{background-color: #ffffff;}
	.ababu{background-color: #f8f1f1;}
</style>