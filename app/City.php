<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	public function scopeActive($query)
	{
		return $query->where('status',1);
	}

	public function scopeSlug($query,$slug)
	{
		return $query->where('slug',$slug);
	}
    public function packages(){return $this->hasMany(TravelPackage::class);}
    public function clients(){return $this->hasMany(Client::class);}
}
