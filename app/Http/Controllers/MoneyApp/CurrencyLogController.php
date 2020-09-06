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

        $idrCurrency = CurrencyLog::latest()->first();
        return response()->json([
            'idr_value' => $idrCurrency->value * $request->amount
        ], 200);
    }
}
