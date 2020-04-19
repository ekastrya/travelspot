<?php

namespace Tests\Feature;

use App\RssFeed;
use App\RssChannel;
use Tests\TestCase;

class ApiRssFeedTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_retrieve_all_feeds()
    {
        $rss_channels = factory(RssChannel::class, $n = 5)->create()->each(function($ch){
            $ch->feeds()->save(factory(RssFeed::class)->make());
        });
        $rss_feeds = RssFeed::with('channel')->get();
    	$this->get('/api/rss-feed/all')
    		 ->assertStatus(200)
    		 ->assertJson($rss_feeds->toArray());
    }

    public function test_can_retrieve_feed_by_id()
    {
        $rss_channels = factory(RssChannel::class, $n = 5)->create()->each(function($ch){
            $ch->feeds()->save(factory(RssFeed::class)->make());
        });
        $feed = RssFeed::where('id', $feed_id = rand(1, $n) )->with('channel')->first();
        $this->json('GET', '/api/rss-feed/' . $feed_id)
             ->assertStatus(200)
             ->assertJson($feed->toArray());
    }
}
