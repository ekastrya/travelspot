<?php

namespace App\Http\Controllers;

use App\RssFeed;
use Illuminate\Http\Request;

class RssFeedController extends Controller
{
    public function getFeed($id) {
    	if(strtolower($id) == 'all'){
    		return response()->json(RssFeed::all());
    	} else {
    		return response()->json(RssFeed::find($id));
    	} 
    }

	public function putFeed(Request $request, $id) {
		$this->validate($request,	[ 'rss_channel_id' => 'required'
                                    , 'description' => 'required'
                                    , 'pub_date' => 'required'
                                    , 'status' => 'required'
                                    , 'title' => 'required'
                                    , 'link' => 'required'
									]);

		$feed = RssFeed::find($id);
        $feed->rss_channel_id = $request->rss_channel_id;
        $feed->description = $request->description;
        $feed->pub_date = $request->pub_date;
        $feed->status = $request->status;
        $feed->title = $request->title;
        $feed->link = $request->link;
		$feed->save();

		return response(null, 204);
	}

	public function deleteFeed(Request $request, $id) {
		$feed = RssFeed::find($id);
		$feed->delete();
		return response(null, 204);
	}
}
