<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Free;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class FreeController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status'     => 'required',
            'trx_id'     => 'required',
            'amount'   => 'required',
            'page'   => 'required',
            'package_id'   => 'required',
            'booth_id'   => 'required'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        //create post
        $post = Free::create([
            'status'   => $request->status,
            'trx_id'   => $request->trx_id,
            'amount'   => $request->amount,
            'payload'   => $request->payload,
            'page'   => $request->page,
            'package_id'   => $request->package_id,
            'booth_id'   => $request->booth_id,
        ]);

        //return response
        $call['status'] = $post;
        return response()->json($call, 200);
    }
}
