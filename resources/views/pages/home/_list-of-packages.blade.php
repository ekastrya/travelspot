<div class="snappr-section" id="photographers">
   <div class="snappr-container snappr-w-container">
      <h2 class="snappr-center snappr-new-section-heading">Destinasi Wisata <span class="snappr-new-section-heading-accent">terpopuler</span>.</h2>
      <p class="snappr-center snappr-new-section-description">Travelspot hanya menampilkan destinasi wisata dengan rating terbaik.</p>
      <div class="row">
         {{-- Question::orderByRaw('RAND()')->take(10)->get(); --}}
         @foreach($destinations as $dest)
         <div class="col-sm-12 col-md-3">
           <div class="destination-image"><img src="{!! $dest['image_url'] !!}" /></div>
           <div class="destination-title text-center">{{ $dest['title'] }}</div>
           <div class="destination-price text-center">{{ $dest['price'] }}</div>
           <div class="text-center"><a href="{{ route('payment.checkout',['image'=>$dest['image_url'],'title'=>$dest['title'],'price'=>$dest['price']]) }}">Pesan sekarang</a></div>
         </div>
         @endforeach
      </div>
   </div>
</div>

<style>
   .putih{background-color: #ffffff;}
   .ababu{background-color: #f8f1f1;}
</style>