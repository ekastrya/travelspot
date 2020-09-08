<?php

namespace App\Http\Controllers\KirimPesan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\KirimPesanService;

class LoginController extends Controller
{
    public function __invoke()
    {
        $auth = KirimPesanService::login();
        try{
            return KirimPesanService::send_text(
                $auth['data']['token'],
                '6289654952374',
                'TravelSpot Pesawat Anda menuju Bali (DPS) akan berangkat dalam 2 jam. Pesan Taxi | Cari Rute'
            );
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }
}
