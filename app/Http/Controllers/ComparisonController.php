<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class ComparisonController extends Controller
{
    public function addPackage(Request $request)
    {
    	if($request->session()->has('p1')){
			if($request->session()->has('p2')){
				return redirect()->route('compare.result');
			} else {
				session(['p2' => $request->title]);
				return redirect()->to('/');
			}
    	} else {
    		session(['p1' => $request->title]);
			return redirect()->to('/');
    	}
    }

    public function clearComparison(Request $request)
    {
    	$request->session()->flush();
    	return redirect()->to('/');
    }

    public function getResult(Request $request)
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

    	return view('pages.comparison-result', [
			'destinations' => collect($array)
		]);
    }
}
