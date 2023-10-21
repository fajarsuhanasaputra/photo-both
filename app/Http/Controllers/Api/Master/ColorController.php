<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\Color;

class ColorController extends Controller {

    public function index() {
        $data = Color::latest()->get();
        return response()->json([
                    'success' => true,
                    'message' => 'List Data Color',
                    'data' => $data
                        ], 200);
    }

}
