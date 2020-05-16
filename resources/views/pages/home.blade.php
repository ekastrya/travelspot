@extends('layouts.global')

@section('content')
	<div class="site__home">
        <div class="site__home-hero">
            <div class="site__home-hero-image-container overlay-gradient"><img srcset="/img/jumbotron-image.jpg" class="site__home-hero-image" src="/img/jumbotron-image-smaller.jpg" alt="3a5bf9b1 a389 4d69 a29f e2d54a67a5dc" /></div>
            <div class="container">
                <div class="hero__caption">
                    <h1 class="hero__title" style="font-size: 30px;">HARGA MULAI DARI Rp 600.000</h1>
                    <p class="hero__subtitle" style="font-size: 18px;">Liburan seru tidak harus mahal.</p>
                    <div class="search-box site__home-search-box">
                        <input class="search-box__input" placeholder="Cari Kota Tujuan" /><button class="search-box__button hidden-sm-down" type="submit">CARI</button>
                        <div class="search-box__dropdown">
                            <div class="search-box__not-found">Kota yang Kamu cari tidak ditemukan, namun Kamu bisa request <span><a href="/request-city">di sini</a></span></div>
                            <ul class="search-box__data">
                                <li class="search-box__group-item">INDONESIA</li>
                                @foreach(\App\City::active()->get() as $kota)
                                <li class="search-box__item" data-url="{{url('/cari/photografer/di-kota/'.$kota->slug)}}"><a class="search-box__item-name" href="{{url('/cari/photografer/di-kota/'.$kota->slug)}}">{{$kota->name}}</a><a class="search-box__item-button" style="float: none;" href="{{url('/cari/photografer/di-kota/'.$kota->slug)}}">Booking</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php /* @ include('pages.home._specialities') */ ?>

        <?php /*
        <div class="hiw container">
            <div class="row">
                <div class="hiw__caption col-xs-12">
                    <h3>How It Works</h3>
                    <p style="text-align: center">Pixxie akan mengabadikan event / perjalanan liburan kamu dengan cara mudah!</p>
                </div>
                <div class="hiw__steps">
                    <div class="col-md-4">
                        <div class="hiw__step-item">
                            <img data-src="{ {asset('img/hiw/step-1.png')} }" class="b-lazy " src="{ {asset('img/hiw/step-1.png')} }" />
                            <h3>Pesan</h3>
                            <p style="text-align: center">Pilih kota &amp; jenis event</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="hiw__step-item">
                            <img data-src="{ {asset('img/hiw/step-2.png')} }" class="b-lazy " src="{ {asset('img/hiw/step-2.png')} }" />
                            <h3>Foto</h3>
                            <p style="text-align: center">Fotografer lokal yang akan<br />mengabadikan event kamu</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="hiw__step-item">
                            <img data-src="{ {asset('img/hiw/step-3.png')} }" class="b-lazy " src="{ {asset('img/hiw/step-3.png')} }" />
                            <h3>Download</h3>
                            <p style="text-align: center">Dalam 3 hari kerja kamu dapat memilih &amp; download foto yang sudah diedit</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        */ ?>

        @include('pages.home._list-of-packages')
        
    </div>
@endsection

@section('headscriptbefore')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" media="all" href="{{asset('css/snappr.css')}}" />
<style type="text/css">
h1{color:white}
.snappr-new-section-heading{color: #212121;}
</style>
@endsection

@section('headscript')
  <link rel="stylesheet" type="text/css" href="{{asset('slick/slick.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('slick/slick-theme.css')}}">
  <style>
    .kartu{
      border:1px solid #d3d8dc;
      border-radius: 4px;
      width: 95%;
      margin: 0 auto;
      padding: 15px 7px;
      height: 380px;
      overflow: hidden;
      box-shadow: 0 2px 12px 0 rgba(0, 0, 0, .13);
      cursor: pointer;
    }
    .card a{color:#424242;}
    .namakota em a{color:#818a95;}
    .slick-prev:before,
    .slick-next:before {
        color: black;
    }
  </style>
@endsection

@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="{{asset('js/snappr.js')}}"></script>
<script src="{{asset('slick/slick.js')}}" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(document).on('ready', function() {
  $(".regular").slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
});
</script>
@endsection