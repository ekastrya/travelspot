<?php

namespace Tests\Feature;

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
        $data = [];
    	$this->get('/api/rss-channel/all')
    		 ->assertStatus(200)
    		 ->assertJson($data);
    }
}
