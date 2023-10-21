<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\SettingDefault;
use App\Models\Voucher;
use Carbon\Carbon;
use Str;

class OyController extends Controller {

    private $data_setting;

    public function __construct() {
        $this->data_setting = SettingDefault::find(1);
    }

    public function contoh_index1(Request $request) {
//        $curl = curl_init();
        $request = new HTTP_Request2();
        $request->setUrl('https://partner.oyindonesia.com/api/payment-routing/create-transaction');
        $request->setMethod(HTTP_Request2::METHOD_POST);
        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Content-Type' => 'application/json',
            'x-oy-username' => 'bonophotobooth',
            'x-api-key' => env('API_KEY', 'c4533efd-240a-4b4b-86be-d6b13f098247'),
        ));
        $request->setBody('{\n    "partner_user_id": "USR-20211117-1029",\n    "partner_trx_id": "TRX-20211117-1030",\n    "need_frontend": false,\n    "sender_email": "sender@gmail.com",\n    "receive_amount": 14000,\n    "list_enable_payment_method": "VA",\n    "list_enable_sof": "002",\n    "va_display_name": "partner_brand",\n    "payment_routing": [{\n        "recipient_bank": "014",\n        "recipient_account": "1234567890",\n        "recipient_amount": 10000,\n        "recipient_email": "recipient_bca@gmail.com"\n    }]\n}');
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                echo $response->getBody();
            } else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
            }
        } catch (HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        dd($response);
    }

    protected function useVoucher($id, $price) {
        if (!empty($id)) {
            $voucher = Voucher::whereId($id)
                    ->whereDate('start', '<=', Carbon::now())
                    ->whereDate('expired', '>=', Carbon::now())
                    ->first();
            if (!empty($voucher)) {
                $disc = $voucher->type == 'percent' ? ($price * $voucher->value) / 100 : $voucher->value;
                return $price - $disc;
            }
            return $price;
        }
        return $price;
    }

    public function createTransaction(Request $request) {
        $data = $request->all();
        $amount = $this->useVoucher($request->voucher_id, $this->data_setting->price);
        $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'x-oy-username' => 'bonophotobooth',
                    'x-api-key' => env('API_KEY', 'c4533efd-240a-4b4b-86be-d6b13f098247'),
                ])->post('https://partner.oyindonesia.com/api/payment-routing/create-transaction', [
//            "partner_user_id" => $data['USR-20211117-1029'],
//            "partner_trx_id" => $data['TRX-20211117-1030'],
//            "need_frontend" => $data['false'],
//            "sender_email" => $data['sender@gmail.com'],
//            "receive_amount" => $data['14000'],
//            "list_enable_payment_method" => $data['VA'],
//            "list_enable_sof" => $data['002'],
//            "va_display_name" => $data['partner_brand'],
            // "partner_user_id" => 'USR-20211117-1029',
            "partner_trx_id" => "TRX-" . Str::uuid(),
            "need_frontend" => false,
            "sender_email" => null,
            "receive_amount" => $amount,
            "list_enable_payment_method" => 'QRIS',
            "list_enable_sof" => 'QRIS',
            "va_display_name" => 'bonophotobooth',
            "trx_counter" => 1,
//            "trx_expiration_time" => Carbon::now()->addMinutes(1)->addSeconds(30)
//            "payment_routing" => [
//                [
//                    "recipient_bank" => 014,
//                    "recipient_account" => 1234567890,
//                    "recipient_amount" => 10000,
//                    "recipient_email" => 'recipient@gmail.com',
//                    
//                    
////                    "recipient_bank" => $data['014'],
////                    "recipient_account" => $data['1234567890'],
////                    "recipient_amount" => $data['10000'],
////                    "recipient_email" => $data['recipient@gmail.com']
//                ],
//            ]
        ]);

        if ($response->status() == 200) {
            return response()->json($response->json(), 200);
        } else {
            return response()->json(['error' => 'Unexpected HTTP status: ' . $response->status() . ' ' . $response->reason()], $response->status());
        }
    }

    public function checkTransaction(Request $request) {
        $request->validate(['partner_trx_id' => 'required']);
        $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'x-oy-username' => 'bonophotobooth',
                    'x-api-key' => env('API_KEY', 'c4533efd-240a-4b4b-86be-d6b13f098247'),
                ])->post('https://partner.oyindonesia.com/api/payment-routing/check-status', [
            'partner_trx_id' => $request->partner_trx_id,
            'send_callback' => true,
        ]);
        return response()->json($response->json());
    }

//    public function check(Request $request) {
//        $data = $request->all();
//        $response = Http::withHeaders([
//                    'Content-Type' => 'application/json',
//                    'x-oy-username' => 'bonophotobooth',
//                    'x-api-key' => env('API_KEY', 'c4533efd-240a-4b4b-86be-d6b13f098247'),
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
//            "trx_expiration_time" => Carbon::now()->addMinute()
//        ]);
//        if ($response->status() == 200) {
//            return response()->json($response->body(), 200);
//        } else {
//            return response()->json(['error' => 'Unexpected HTTP status: ' . $response->status() . ' ' . $response->reason()], $response->status());
//        }
//    }

}
