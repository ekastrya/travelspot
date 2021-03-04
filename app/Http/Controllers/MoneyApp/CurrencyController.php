<?php

namespace App\Http\Controllers\MoneyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CurrencyLog;

class CurrencyController extends Controller
{
    public function getConvert(Request $request)
    {
        $this->validate($request, [
            'access_key' => 'required',
            'from' => 'required',
            'to' => 'required',
            'amount' => 'required'
        ]);

        // Check if data exists
        if(CurrencyLog::count() == 0){
            // Create new entry if no data available
            CurrencyLog::create(['idr' => 0]);
        }

        $rate = CurrencyLog::latest()->first();

        return response()->json([
            'success' => true,
            'query' => [
                'from' => 'USD',
                'to' => 'IDR',
                'amount' => $request->amount
            ],
            'info' => [
                'timestamp' => date('YmdHis'),
                'rate' => $rate->idr
            ],
            'historical' => '',
            'date' => date('Y-m-d'),
            'result' => floor($rate->idr * $request->amount)
        ], 200);
    }
}
