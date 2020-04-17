<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RssChannel;
use Faker\Generator as Faker;

$factory->define(RssChannel::class, function (Faker $faker) {
    return	[ 'last_build_date'	=> now()
    		, 'description'		=> $faker->text
    		, 'status'			=> $faker->randomElement(['0','1'])
    		, 'title'			=> $faker->sentence()
    		, 'link'			=> $faker->url
    		];
});
