<?php

namespace App\Http\Controllers\Api\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery\GalleryImage;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\Facades\Image;
use App\Http\Resources\Gallery\ImageResource;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\LinkDownload;
use Illuminate\Support\Facades\File;

class ImageController extends Controller {

    public function index() {
        $data = GalleryImage::latest()->get();
        return ImageResource::collection($data);
//        return response($data, Response::HTTP_ACCEPTED);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
//                    'name' => 'required',
                    'phone' => 'required|numeric',
                    'email' => 'required',
//                    'kritik_saran' => 'nullable',
                    'img_data' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $code = \uniqid();

        if ($request->hasFile('img_data')) {
            $photo = $request->file('img_data');
            $ext = strtolower($photo->getClientOriginalExtension());
            $image_full_name = Str::slug($request->name) . '.' . $ext;
            $new_folder = File::makeDirectory(storage_path('app/public/images/gallery') . '/' . $code, $mode = 0777, true, true);
            $location = storage_path('app/public/images/gallery') . '/' . $code . '/' . $image_full_name;
            Image::make($photo)->save($location);
            $image['img_data'] = $image_full_name;
        }

        //save to database
        $title = '[Confirmation] Terima kasih telah berkunjung';

        $post = GalleryImage::create([
//                    'name' => $request->name,
                    'phone' => $request->phone,
                    'code' => $code,
                    'img_data' => $image_full_name,
                    'email' => $request->email,
//                    'kritik_saran' => $request->kritik_saran,
                    'deleted_at' => Carbon::now()->addDays(1),
        ]);

        if ($post) {
            $sendmail = Mail::to($post['email'])->send(new LinkDownload($title, $post));
            if (empty($sendmail)) {
                return response()->json(['message' => 'Mail Sent fail'], 400);
            } else {
                return response()->json(['message' => 'Mail Sent Successfully'], 200);
            }
        }
    }

    public function generate($id) {
        $data = GalleryImage::findOrFail($id);
        $qrcode = QrCode::size(400)->generate($location);
//        return view('qrcode', compact('qrcode'));
        return response($qrcode, Response::HTTP_ACCEPTED);
//        return response()->json($qrcode, 200);
    }

}
