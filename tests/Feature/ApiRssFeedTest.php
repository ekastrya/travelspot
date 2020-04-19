<?php

namespace Tests\Feature;

use App\RssFeed;
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
        $rss_feeds = factory(RssFeed::class, $n = 1)->create();
    	$this->get('/api/rss-feed/all')
    		 ->assertStatus(200)
    		 ->assertJson($rss_feeds->toArray());
    }

    public function test_can_retrieve_feed_by_id()
    {
        $rss_feeds = factory(RssFeed::class, $n = 5)->create();
        $feed = RssFeed::find( $feed_id = rand(1, $n) );
        $this->json('GET', '/api/rss-feed/' . $feed_id)
             ->assertStatus(200)
             ->assertJson($feed->toArray());
    }
}
