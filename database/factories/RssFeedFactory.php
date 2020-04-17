<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RssFeed;
use Faker\Generator as Faker;

$factory->define(RssFeed::class, function (Faker $faker) {
    return	[ 'rss_channel_id'	=> $faker->numberBetween($min = 1, $max = 10)
    		, 'description'		=> $faker->text
    		, 'pub_date'		=> now()
			, 'status'			=> $faker->randomElement(['0','1'])
			, 'title'			=> $faker->sentence()
			, 'link'			=> $faker->url
    		];
});
