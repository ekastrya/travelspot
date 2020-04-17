<?php

namespace Tests\Feature;

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
        $data = [];
    	$this->get('/api/rss-feed/all')
    		 ->assertStatus(200)
    		 ->assertJson($data);
    }
}
