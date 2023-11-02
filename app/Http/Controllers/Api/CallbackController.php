<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Callback;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class CallbackController extends BaseController
{

//stagging

    public function index(Request $request)
    {
        $data = Callback::all();
        return response()->json(['data' => $data]);
    }

    public function show(Request $request, $id)
    {
        $data = Callback::where('trx_id', $id)->orderBy('id', 'desc')->first();
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {

        //stagging
        $validator = Validator::make($request->all(), [
            'partner_trx_id' => 'required',
            'booth_id' => 'required',
            'package_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $transaction = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-oy-username' => 'adminbutuhmoment',
            'x-api-key' => env('API_KEY', '78042200-e174-4490-a720-66d11340c4f4'),
        ])->post(env('API_PAYMENT_URL', 'https://api-stg.oyindonesia.com') . '/api/payment-routing/check-status', [
            'partner_trx_id' => $request->partner_trx_id,
            // 'send_callback' => true,
        ]);

        $tr = $transaction->json();

        $status = !empty($tr->status) ? $tr->status['message'] ?? $tr['payment_status'] : $tr['payment_status'];
        $page = $request->discount && $request->discount != 'none'  ? 'slide - voucher' . $request->discount . '%' : 'slide';
        if ($request->discount == 100) $status = 'FREE_PAYMENT';
        $call = Callback::updateOrCreate([
            'trx_id' => $tr['trx_id']
        ], [
            'status' => $status,
            'booth_id' => $request->booth_id, // booth
            'package_id' => $request->package_id, // paket
            'page' => $page, // first page is slide
            'amount' => $tr['received_amount'],
            'payload' => $tr,
        ]);
        $call['status'] = $status;
        return response()->json($call, 200);
    }

    public function upgrade()
    {
        $data = Callback::all();
        foreach ($data as $dt) {
            Callback::whereId($dt->id)->where('amount', 0)->update(['amount' => $dt->payload->receive_amount ?? 0]);
        }
    }

    public function analytic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'trx_id' => 'required',
            'page' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = Callback::where('trx_id', $request->trx_id);
        $callback = Callback::select('page')->where('trx_id', $request->trx_id)->first();

        $data->update([
            'page' => $callback->page . ' - ' . $request->page,
        ]);

        return response()->json([
            'message' => 'success updated analytics'
        ], 200);
    }
}
