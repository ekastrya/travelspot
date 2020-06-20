<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestBook extends Model
{
    protected $fillable = ['fullname','email','phone','rating','opinion','role'];
}
