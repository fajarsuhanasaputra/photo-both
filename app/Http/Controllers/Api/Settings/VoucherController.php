<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Http\Resources\VoucherResource;
use Carbon\Carbon;

class VoucherController extends Controller {

    public function index() {
        $data = Voucher::latest()->get();
        return VoucherResource::collection($data);
    }

    public function storeVoucher(Request $request) {
        $coupon = Voucher::whereDate('expired', '>=', Carbon::now())->where('code', $request->code)->first();
        if (!$coupon) {
                    return response()->json([ 'Message' => 'Invalid Voucher code. Please try again.',], 502);
        }

        return response()->json([
                    'Message' => 'A new Voucher have been created for you!',
                    'Data Valid' => $coupon,
                        ], 201);
    }

}
