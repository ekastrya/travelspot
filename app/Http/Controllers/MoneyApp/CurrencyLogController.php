<?php

namespace App\Http\Controllers\MoneyApp;

use App\CurrencyLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrencyLogController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request,[
            'amount' => 'required'
        ]);

        if(CurrencyLog::count() == 0){
            CurrencyLog::create(['idr' => 0]);
        }

        $idrCurrency = CurrencyLog::latest()->first();
        return response()->json([
            'idr_value' => $idrCurrency->idr * $request->amount
        ], 200);
    }
}
