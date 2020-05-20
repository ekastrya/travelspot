<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\ApiRequestor;
use Midtrans\Config;
use Midtrans\CoreApi;
use Midtrans\Notification;
use Midtrans\Sanitizer;
use Midtrans\Snap;
use Midtrans\SnapApiRequestor;
use Midtrans\Transaction;

class PaymentController extends Controller
{
	public function getCheckout(Request $request)
	{
		$image = $request->image;
		$title = $request->title;
		$price = $request->price;
		return view('pages.checkout', [
			'token' => self::getSnapToken($request, str_replace(',','',substr($price,3,12))),
			'image' => $image,
			'title' => $title,
			'price' => $price
		]);
	}

	public function getSnapToken(Request $request, $price=0)
	{

        $item_list = array();
        $amount = 0;
        Config::$serverKey = env('MIDTRANS_SANDBOX_SERVER_KEY');
        if (!isset(Config::$serverKey)) {
            return "Please set your payment server key";
        }
        Config::$isSanitized = true;

        // Enable 3D-Secure
        Config::$is3ds = true;
        
        // Required

         $item_list[] = [
                'id' => "111",
                'price' => $price,
                'quantity' => 1,
                'name' => $request->title
        ];

        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => $price, // no decimal allowed for creditcard
        );


        // Optional
        $item_details = $item_list;

        // Optional
        $billing_address = array(
            'first_name'    => "Andri",
            'last_name'     => "Litani",
            'address'       => "Mangga 20",
            'city'          => "Jakarta",
            'postal_code'   => "16602",
            'phone'         => "081122334455",
            'country_code'  => 'IDN'
        );

        // Optional
        $shipping_address = array(
            'first_name'    => "Obet",
            'last_name'     => "Supriadi",
            'address'       => "Manggis 90",
            'city'          => "Jakarta",
            'postal_code'   => "16601",
            'phone'         => "08113366345",
            'country_code'  => 'IDN'
        );

        // Optional
        $customer_details = array(
            'first_name'    => "Andri",
            'last_name'     => "Litani",
            'email'         => "andri@litani.com",
            'phone'         => "081122334455",
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
        );

        // Optional, remove this to display all available payment methods
        $enable_payments = array();

        // Fill transaction details
        $transaction = array(
            'enabled_payments' => $enable_payments,
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );
        // return $transaction;
        try {
            $snapToken = Snap::getSnapToken($transaction);
            return $snapToken;
            return response()->json($snapToken);
            // return ['code' => 1 , 'message' => 'success' , 'result' => $snapToken];
        } catch (\Exception $e) {
            dd($e);
            return ['code' => 0 , 'message' => 'failed'];
        }

	}

	public function getNotif()
	{
		//
	}

	public function getSuccess()
	{
		//
	}

	public function getCancel()
	{
		//
	}

	public function getError()
	{
		//
	}

}
