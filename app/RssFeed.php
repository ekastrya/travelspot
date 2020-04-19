<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RssFeed extends Model
{
    public function channel() {
    	return $this->belongsTo(RssChannel::class);
    }
}
