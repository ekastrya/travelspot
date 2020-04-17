<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithoutMiddleware;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
	// use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRssChannelFactory()
    {
        $rss_channels =	factory(\App\RssChannel::class, $n = 10)->create()
        														->each(function ($channel) {
							$channel->feeds()
								 	->save(factory(\App\RssFeed::class)
								 	->create());
						});
        $this->assertTrue($n == $rss_channels->count());
    }
}
