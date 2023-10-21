<?php

namespace App\Http\Controllers\Api\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Images\ImagePrint;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Http\Resources\Gallery\ImagePrintResource;
use Illuminate\Support\Facades\Mail;
use App\Mail\LinkDownload;
use App\Models\ListContact;

class ImagePrintController extends Controller
{

    public function index()
    {
        $data = ImagePrint::latest()->get();
        return ImagePrintResource::collection($data);
    }

    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            // 'img_print' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'img_data' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10240',
            'transaksi_id' => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $code = \uniqid();

        if ($request->hasFile('img_data')) {
            $photo = $request->file('img_data');
            $ext = strtolower($photo->getClientOriginalExtension());
            $image_full_name = Carbon::now()->format('Y-m-d-H:i:s') . '.' . $ext;
            $new_folder = File::makeDirectory(storage_path('app/public/images/list-contacts') . '/' . $code, $mode = 0777, true, true);
            $location = storage_path('app/public/images/list-contacts') . '/' . $code . '/' . $image_full_name;
            Image::make($photo)->save($location);
            $image['img_data'] = $image_full_name;
        }


        //save to database
        $blog = ImagePrint::create([
            'code' => $code,
            'transaksi_id' => $request->transaksi_id,
            'img_data' => $image_full_name,
            'status' => 'created',
        ]);

        //success save to database
        if ($blog) {

            return response()->json([
                'success' => true,
                'message' => 'Image Created',
                'data' => $blog
            ], 201);
        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Image Failed to Save',
        ], 409);
    }

}
