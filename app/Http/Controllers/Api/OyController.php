<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Models\SettingDefault;
use App\Models\Transaction;
use App\Models\Voucher;
use Carbon\Carbon;
use Str;

class OyController extends Controller
{
    private $data_setting;

    public function __construct()
    {
        $this->data_setting = SettingDefault::find(1);
    }

    // protected function useVoucher($id, $price)
    // {
    //     if (!empty($id)) {
    //         $voucher = Voucher::whereId($id)
    //             ->whereDate('start', '<=', Carbon::now())
    //             ->whereDate('expired', '>=', Carbon::now())
    //             ->first();
    //         if (!empty($voucher)) {
    //             $disc = $voucher->type == 'percent' ? ($price * $voucher->value) / 100 : $voucher->value;
    //             return $price - $disc;
    //         }
    //         return $price;
    //     }
    //     return $price;
    // }

    public function createTransaction(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'price' => 'required' ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // $amount = $this->useVoucher($request->voucher_id, $request->price);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-oy-username' => 'adminbutuhmoment',
            'x-api-key' => env('API_KEY', '78042200-e174-4490-a720-66d11340c4f4'),
        ])->post(env('API_PAYMENT_URL', 'https://api-stg.oyindonesia.com').'/api/payment-routing/create-transaction', [
            "partner_trx_id" => "TRX-" . Str::uuid(),
            "need_frontend" => false,
            "sender_email" => null,
            "receive_amount" => $request->price,
            "list_enable_payment_method" => 'QRIS',
            "list_enable_sof" => 'QRIS',
            "va_display_name" => 'adminbutuhmoment',
            "trx_counter" => 1,
        ]);

        return response()->json($response->json());
    }

    public function checkTransaction(Request $request)
    {
        $request->validate(['partner_trx_id' => 'required']);
        $transaction = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-oy-username' => 'adminbutuhmoment',
            'x-api-key' => env('API_KEY', '78042200-e174-4490-a720-66d11340c4f4'),
        ])->post(env('API_PAYMENT_URL', 'https://api-stg.oyindonesia.com').'/api/payment-routing/check-status', [
            'partner_trx_id' => $request->partner_trx_id,
            // 'send_callback' => true,
        ]);
        $tr = $transaction->json();
        return response()->json($tr);
    }
}
