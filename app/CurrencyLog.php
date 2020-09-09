<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyLog extends Model
{
    protected $connection = 'mysql_moneyapp';
    protected $fillable = ['idr'];
}
