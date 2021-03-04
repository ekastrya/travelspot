<?php

namespace App\Http\Controllers\MoneyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function getConvert(Request $request)
    {
        return response()->json(null, 200);
    }
}
