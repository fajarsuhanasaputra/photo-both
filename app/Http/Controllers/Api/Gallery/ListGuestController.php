<?php

namespace App\Http\Controllers\Api\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\ListGuest;

class ListGuestController extends Controller {

    public function index() {
        $data = ListGuest::latest()->get();
        return response()->json([
                    'success' => true,
                    'message' => 'List Guest',
                    'data' => $data
                        ], 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'phone' => 'required|numeric',
                    'email' => 'required',
                    'kritik_saran' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = ListGuest::create([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'kritik_saran' => $request->kritik_saran,
        ]);

        if ($data) {

            return response()->json([
                        'success' => true,
                        'message' => 'Data Guest Created',
                        'data' => $data
                            ], 201);
        }

        return response()->json([
                    'success' => false,
                    'message' => 'Data Guest Failed to Save',
                        ], 409);
    }

}
