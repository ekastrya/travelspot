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

	public function putChannel(Request $request, $id) {
		$this->validate($request,	[ 'last_build_date' => 'required'
									, 'description' => 'required'
									, 'status' => 'required'
									, 'title' => 'required'
									, 'link' => 'required'
									]);

		$channel = RssChannel::find($id);
		$channel->last_build_date = $request->last_build_date;
		$channel->description = $request->description;
		$channel->status = $request->status;
		$channel->title = $request->title;
		$channel->link = $request->link;
		$channel->save();

		return response(null, 204);
	}

	public function postChannel(Request $request) {
		$this->validate($request,	[ 'description' => 'required'
									, 'status' => 'required'
									, 'title' => 'required'
									, 'link' => 'required'
									//'last_build_date' => 'required'
									]);

		$channel = new RssChannel;
		$channel->save();

		factory(RssChannel::class)->create([			
			// 'last_build_date' => $request->last_build_date,
			'description' => $request->description,
			'status' => $request->status,
			'title' => $request->title,
			'link' => $request->link
		]);

		return response(null, 201);
	}

	public function deleteChannel(Request $request, $id) {
		$channel = RssChannel::find($id);
		$channel->delete();
		return response(null, 204);
	}
}
