<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Models\SettingDefault;

class HomeController extends Controller {

//    public function __construct() {
//        $this->middleware('auth');
//    }

    private $data_setting;

    public function __construct() {
        $this->data_setting = SettingDefault::find(1);
        $this->middleware('auth');
    }

    public function index() {
        return view('backend.menu.dashboard.dashboard');
    }

    public function check(Request $request) {
//        $data = $request->all();
//        $response = Http::withHeaders([
//                    'Content-Type' => 'application/json',
//                    'x-oy-username' => 'bonophotobooth',
//                    'x-api-key' => 'c4533efd-240a-4b4b-86be-d6b13f098247'
//                ])->post('https://partner.oyindonesia.com/api/payment-routing/create-transaction', [
//            "partner_user_id" => 'USR-20211117-1029',
//            "partner_trx_id" => 'TRX-20211117-1030',
//            "need_frontend" => false,
//            "sender_email" => null,
//            "receive_amount" => $this->data_setting->price,
//            "list_enable_payment_method" => 'QRIS',
//            "list_enable_sof" => 'QRIS',
//            "va_display_name" => 'bonophotobooth',
//            "trx_counter" => 1,
//            "trx_expiration_time" => "2023-02-01 17:41:00"
//        ]);

        $x = \App\Models\GeneratePayment::create([
                    "partner_user_id" => 'USR-20211117-1029',
                    "partner_trx_id" => 'TRX-20211117-1030',
                    "need_frontend" => false,
                    "sender_email" => null,
                    "receive_amount" => $this->data_setting->price,
                    "list_enable_payment_method" => 'QRIS',
                    "list_enable_sof" => 'QRIS',
                    "va_display_name" => 'bonophotobooth',
                    "trx_counter" => 1,
                    "trx_expiration_time" => Carbon::now()->subDay()
        ]);

        dd($x);
//        if ($response->status() == 200) {
//            return response()->json($response->body(), 200);
//        } else {
//            return response()->json(['error' => 'Unexpected HTTP status: ' . $response->status() . ' ' . $response->reason()], $response->status());
//        }
    }

}
