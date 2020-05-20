<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class PageController extends Controller
{
	public function getHomePage()
	{
		$client = new Client();
		$crawler = $client->request('GET', 'https://www.misteraladin.com/tours/destination/bali');
		$array = [];

		foreach( $crawler->filter('h4.product-title') as $key => $title) { 
			// print_r($title);
			$array[$key]['title'] = $title->textContent;
		};

		foreach( $crawler->filter('div.product-price_currency') as $key => $price) { 
			// print_r($title);
			$array[$key]['price'] = $price->textContent;
		};

		// $crawler->filter('div.product-price_currency')->each(function($price,$key) { 
		// 	$array[$key]['price'] = $price->text();
		// });


		$crawler->filter('div.product-image img')->each(function($image,$key) use(&$array){ 
			$array[$key]['image_url'] = $image->attr('data-src');
		});

		return view('pages.home', [
			'destinations' => collect($array)
		]);
	}

	public function getDestinationsPage()
	{
		return view('pages.destinations');
	}

	public function getHowItWorksPage()
	{
		return view('pages.how-it-works');
	}

	public function getPromoPage()
	{
		return view('pages.promo');
	}

	public function getAboutPage()
	{
		return view('pages.about-us');
	}

	public function getFaqPage()
	{
		return view('pages.faq');
	}

	public function getPrivacyPolicyPage()
	{
		return view('pages.privacy-policy');
	}

	public function getRequestCityPage()
	{
		return view('pages.request-city');
	}

	public function getContactUsPage()
	{
		return view('pages.contact-us');
	}

	public function getJoinPage()
	{
		return view('pages.join');
	}

	public function postJoin(Request $request)
	{
		$this->validate($request, [
            'fullname'             => 'required|string|max:191',
            'tagline'              => 'required|string|max:191',
            'email'                => 'required|string|email|max:191|unique:users',
            'phone'                => 'required|string|max:20',
            'city_id'              => 'required|integer',
            'camera'               => 'required|string|max:191',
            'lens'                 => 'required|string|max:191',
            'additional_equipment' => 'sometimes',
            'instagram_id'         => 'required|string|max:191',
            'cb_travel'            => 'sometimes|integer',
			'cb_acara_kantor'      => 'sometimes|integer',
			'cb_arisan'            => 'sometimes|integer',
			'cb_ulang_tahun'       => 'sometimes|integer',
			'cb_fashion'           => 'sometimes|integer',
			'cb_produk'            => 'sometimes|integer',
			'availability'		   => 'required|integer'
        ]);

        $user = \App\User::create([
            'role_id'  => 2, //photographer
            'email'    => $request->email,
            'password' => '-'
        ]);

        $photographer = new \App\Photographer;
        $photographer->user_id = $user->id;
        $photographer->fullname = $request->fullname;
        $photographer->tagline = $request->tagline;
        $photographer->phone = $request->phone;
        $photographer->city_id = $request->city_id;
        $photographer->camera = $request->camera;
        $photographer->lens = $request->lens;
        $photographer->instagram_id = $request->instagram_id;
        if(isset($request->additional_equipment)){$photographer->additional_equipment = $request->additional_equipment;}
        if(isset($request->cb_travel)){$photographer->cb_travel = 1;}else{$photographer->cb_travel=0;}
		if(isset($request->cb_acara_kantor)){$photographer->cb_acara_kantor = 1;}else{$photographer->cb_acara_kantor=0;}
		if(isset($request->cb_arisan)){$photographer->cb_arisan = 1;}else{$photographer->cb_arisan=0;}
		if(isset($request->cb_ulang_tahun)){$photographer->cb_ulang_tahun = 1;}else{$photographer->cb_ulang_tahun=0;}
		if(isset($request->cb_fashion)){$photographer->cb_fashion = 1;}else{$photographer->cb_fashion=0;}
		if(isset($request->cb_produk)){$photographer->cb_produk = 1;}else{$photographer->cb_produk=0;}
        $photographer->availability = $request->availability;
        $photographer->save();

        $album = new \App\Album;
        $album->photographer_id = $photographer->id;
        $album->name            = 'Profile Picture';
        $album->permission      = 'public';
        $album->save();

        $album = new \App\Album;
        $album->photographer_id = $photographer->id;
        $album->name            = 'Portfolio';
        $album->permission      = 'public';
        $album->save();

        \Auth::login($user);

        try{
	    	\Mail::to($user->email)->send(new \App\Mail\PhotographerRegisterSuccess($photographer));
        } 

        catch(Exception $e) {
        	//
        }

        return redirect('/set-password');
	}

	public function getTC()
	{
		return view('pages.terms-and-condition');
	}

	public function getTCPhotographer()
	{
		return view('pages.terms-and-condition-photographer');
	}

	public function getTOC()
	{
		return view('pages.toc');
	}
	
	public function getTOCPh()
	{
		return view('pages.tocph');
	}

	public function getPhotographerDetail($id)
	{
        $photographer = \App\Photographer::find($id);
        $photos = \App\Photo::whereHas('album', function ($q) use($photographer) {
            $q->where('name', 'Portfolio')
              ->where('photographer_id',$photographer->id);
        })->get();
        $pp = \App\Photo::whereHas('album', function ($q) use($photographer) {
            $q->where('name', 'Profile Picture')
              ->where('photographer_id',$photographer->id);
        })->latest();
        if($pp->count() > 0){
            $active_profile_pic_filename = $pp->first()->folder_name.$pp->first()->file_name;
        } else {
            $active_profile_pic_filename = 'noimage.jpg';
        }
        return view('pages.photographer-detail', compact('photographer','photos','active_profile_pic_filename'));
	}

	public function getBookPhotographer(Request $request, $id)
	{
		session()->put(['booked_photographer_id'=>$id]);
		if($request->session()->has('package')){
			return redirect(route('photographer.book-schedule'));
		} else {
			return redirect('/harga');
		}
	}

	public function getBookPackage(Request $request, $package)
	{
		session()->put(['package'=>$package]);
		if($request->session()->has('booked_photographer_id')){
			return redirect(route('photographer.book-schedule'));
		} else {
			return redirect(route('photographer.list'));
		}
	}

	public function getAllphotographer()
	{
		$photographers = \App\Photographer::approved()->get();
		return view('pages/photographer-list', compact('photographers'));
	}

	public function getBookPhotographerSchedule(Request $request)
	{
		
		if(\Auth::guest() || (\Auth::check() && $request->user()->role->slug != 'client')){
			return redirect('/register')->withMessage('Untuk melakukan booking, Kamu harus login terlebih dahulu');
		}
		if($request->session()->has('booked_photographer_id') && $request->session()->has('package')){
			$id = $request->session()->get('booked_photographer_id');
	        $photographer = \App\Photographer::find($id);

	        $pp = \App\Photo::whereHas('album', function ($q) use($photographer) {
	            $q->where('name', 'Profile Picture')
	              ->where('photographer_id',$photographer->id);
	        })->latest();
	        if($pp->count() > 0){
	            $active_profile_pic_filename = $pp->first()->folder_name.$pp->first()->file_name;
	        } else {
	            $active_profile_pic_filename = 'noimage.jpg';
	        }
			return view('pages/photographer-book-schedule', compact('photographer','active_profile_pic_filename'));
		} else {
			return redirect('/harga');
		}
	}

	public function postBookPhotographerSchedule(Request $request)
	{
		$this->validate($request, [
			'tanggal_submit' => 'required|date_format:"Y-m-d"|after_or_equal:today',
			'jam'            => 'required',
			'lokasi'         => 'required',
			'shoot_type'     => 'required'
        ]);

		if($request->session()->exists('package') == false){
			return redirect('/harga');
		}
		if($request->session()->exists('booked_photographer_id') == false){
			return redirect('/photographer/list');
		}

		$booking = \App\Booking::create([
			'tanggal'         => $request->tanggal_submit,
			'jam'             => $request->jam,
			'lokasi'          => $request->lokasi,
			'package'         => $request->session()->get('package'),
			'shoot_type'	  => $request->shoot_type,
			'client_id'       => $request->user()->client->id,
			'photographer_id' => $request->session()->get('booked_photographer_id')
		]);

		return redirect(route('booking-success',['id'=>$booking->id]));
	}

	public function getBookPhotographerSuccess($id)
	{
		$booking = \App\Booking::find($id);
		return view('pages.photographer-book-success',compact('booking'));
	}
	public function getListofphotographer()
	{
		$photographers = \App\Photographer::latest()->get();
		return view('pages.home.list-of-photographer', compact('photographers'));
	}

	public function getGabungPage()
	{
		return view('pages.gabung.form');
	}

	public function postGabung(Request $request)
	{
		$this->validate($request, [
            'fullname'             => 'required|string|max:191',
            'tagline'              => 'required|string|max:191',
            'email'                => 'required|string|email|max:191|unique:users',
            'phone'                => 'required|string|max:20',
            'city_id'              => 'required|integer',
            'camera'               => 'required|string|max:191',
            'lens'                 => 'required|string|max:191',
            'additional_equipment' => 'sometimes',
            'instagram_id'         => 'required|string|max:191',
            'cb_travel'            => 'sometimes|integer',
			'cb_acara_kantor'      => 'sometimes|integer',
			'cb_arisan'            => 'sometimes|integer',
			'cb_ulang_tahun'       => 'sometimes|integer',
			'cb_fashion'           => 'sometimes|integer',
			'cb_produk'              => 'sometimes|integer',
			'password'             => 'required|confirmed',
			'availability'		   => 'required|integer'

        ]);

        $user = \App\User::create([
            'role_id'  => 2, //photographer
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'normal'   => 0
        ]);

        $photographer = new \App\Photographer;
        $photographer->user_id = $user->id;
        $photographer->fullname = $request->fullname;
        $photographer->tagline = $request->tagline;
        $photographer->phone = $request->phone;
        $photographer->city_id = $request->city_id;
        $photographer->camera = $request->camera;
        $photographer->lens = $request->lens;
        $photographer->instagram_id = $request->instagram_id;
        if(isset($request->additional_equipment)){$photographer->additional_equipment = $request->additional_equipment;}
        if(isset($request->cb_travel)){$photographer->cb_travel = 1;}else{$photographer->cb_travel=0;}
		if(isset($request->cb_acara_kantor)){$photographer->cb_acara_kantor = 1;}else{$photographer->cb_acara_kantor=0;}
		if(isset($request->cb_arisan)){$photographer->cb_arisan = 1;}else{$photographer->cb_arisan=0;}
		if(isset($request->cb_ulang_tahun)){$photographer->cb_ulang_tahun = 1;}else{$photographer->cb_ulang_tahun=0;}
		if(isset($request->cb_fashion)){$photographer->cb_fashion = 1;}else{$photographer->cb_fashion=0;}
		if(isset($request->cb_produk)){$photographer->cb_produk = 1;}else{$photographer->cb_produk=0;}
        $photographer->availability = $request->availability;
        $photographer->save();

        $album = new \App\Album;
        $album->photographer_id = $photographer->id;
        $album->name            = 'Profile Picture';
        $album->permission      = 'public';
        $album->save();

        $album = new \App\Album;
        $album->photographer_id = $photographer->id;
        $album->name            = 'Portfolio';
        $album->permission      = 'public';
        $album->save();

        \Auth::login($user);

        try{
	    	\Mail::to($user->email)->send(new \App\Mail\PhotographerRegisterSuccess($photographer));
        } 

        catch(Exception $e) {
        	//
        }
        
        return redirect('/photographer/home');
	}

	public function getGabungSuksesPage()
	{
		//
	}

	public function getShootTypes($type)
	{
		return view('pages.shoot-types.'.$type);
	}

	public function getPhotographerByCity($city)
	{
		$city = \App\City::slug($city)->with(['photographers'=> function($query){
			$query->approved();
		}])->first();

		return view('pages.photographer-by-city', compact('city'));
	}
}
