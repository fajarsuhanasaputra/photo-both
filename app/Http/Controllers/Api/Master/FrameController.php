<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frame;
use App\Http\Resources\FrameResource;
use App\Models\Booth;

class FrameController extends Controller
{

    //    public function index() {
    //        $data = Frame::latest()->get();
    //        return response()->json([
    //                    'success' => true,
    //                    'message' => 'List Data Frame',
    //                    'data' => $data
    //                        ], 200);
    //    }

    public function index($id)
    {
        // return FrameResource::collection()->paginate(2);
        $data = Booth::find($id);
        $frame = explode(",", $data->frame);

        $booth_frame = array();
        foreach ($frame as $fr) {
            $arr_frame = Frame::find($fr);
            array_push($booth_frame, $arr_frame);
        }

        $key_values = array_column($booth_frame , 'order_number'); 
        array_multisort($key_values, SORT_ASC, $booth_frame);
        // $articles = Frame::latest()->get();
        return FrameResource::collection($booth_frame);
    }
}
