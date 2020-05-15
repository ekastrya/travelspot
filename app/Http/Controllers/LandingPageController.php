<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function __invoke(Request $request) {
    	return view('landing-page');
    	return view('home-page');
    }
}
