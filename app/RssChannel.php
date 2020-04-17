<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RssChannel extends Model
{
    public function feeds() {
    	return $this->hasMany(RssFeed::class);
    }
}
