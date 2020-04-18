<?php

namespace App\Http\Controllers;

use App\RssChannel;
use Illuminate\Http\Request;

class RssChannelController extends Controller
{
    public function getChannel($id) {
    	if(strtolower($id) == 'all'){
    		return response()->json(RssChannel::all());
    	} else {
    		return response()->json(RssChannel::find($id));
    	} 
    }
}
