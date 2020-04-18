<?php

namespace Tests\Feature;

use App\RssChannel;
use Tests\TestCase;

class ApiRssChannelTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_retrieve_all_channels()
    {
        $rss_channels = factory(RssChannel::class, $n = 1)->create();
    	$this->get('/api/rss-channel/all')
    		 ->assertStatus(200)
    		 ->assertJson($rss_channels->toArray());
    }

    public function test_can_retrieve_channel_by_id()
    {
        $rss_channels = factory(RssChannel::class, $n = 5)->create();
        $channel = RssChannel::find( $channel_id = rand(1, $n) );
        $this->json('GET', '/api/rss-channel/' . $channel_id)
             ->assertStatus(200)
             ->assertJson($channel->toArray());
    }
    
    // public function test_can_search_channel_by_keyword_across_all_fields(){}
    
    // public function test_can_create_new_channel_record(){}
    
    // public function test_can_update_channel_record(){}
    
    // public function test_can_delete_channel_record(){}
}
