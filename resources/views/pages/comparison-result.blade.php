@extends('layouts.global')

@section('content')
<div class="site__hiw">
    <div class="site__hiw-header">
        <h1 class="site__hiw-header-title">Perbandingan Paket Wisata</h1>

        <table width="100%">
            <tr>
                <td>
                    @foreach($destinations as $dest)
                        @if( trim(html_entity_decode($dest['title'])) == trim(session('p1')) )
                            
           <div class="destination-image"><img src="{!! $dest['image_url'] !!}" /></div>
           <div class="destination-title text-center">{{ $dest['title'] }}</div>
           <div class="destination-price text-center">{{ $dest['price'] }}</div>
           <div class="text-center"><a href="{{ route('payment.checkout',['image'=>$dest['image_url'],'title'=>$dest['title'],'price'=>$dest['price']]) }}">Pesan sekarang</a></div>
                            @break
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach($destinations as $dest)
                        @if(trim(html_entity_decode($dest['title'])) == trim(session('p2')) )
                            
           <div class="destination-image"><img src="{!! $dest['image_url'] !!}" /></div>
           <div class="destination-title text-center">{{ $dest['title'] }}</div>
           <div class="destination-price text-center">{{ $dest['price'] }}</div>
           <div class="text-center"><a href="{{ route('payment.checkout',['image'=>$dest['image_url'],'title'=>$dest['title'],'price'=>$dest['price']]) }}">Pesan sekarang</a></div>
                            @break
                        @endif
                    @endforeach
                </td>
            </tr>
        </table>
        
        <a href="{{ route('compare.clear') }}">Kosongkan Perbandingan</a>
    </div>

</div>


@endsection

@section('headscript')
@endsection