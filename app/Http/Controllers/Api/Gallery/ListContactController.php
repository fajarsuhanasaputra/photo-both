<?php

namespace App\Http\Controllers\Api\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
//use Intervention\Image\Facades\Image;
//use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\LinkDownload;
use Illuminate\Support\Facades\File;
use App\Models\ListContact;
use App\Http\Resources\Gallery\ListContactResource;
use App\Models\Callback;
use App\Models\Images\ImagePrint;
use App\Models\Package;

//use Illuminate\Support\Facades\DB;

class ListContactController extends Controller
{

    public function index()
    {

        $data = ListContact::latest()->get();
        return ListContactResource::collection($data);
        //  return response($data, Response::HTTP_ACCEPTED);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required',
            'booth_id' => 'required',
            // 'image_print_id' => 'required',
            'transaksi_id' => 'required',
            // 'img_data' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'kritik_saran' => 'nullable',
        ]);

        // response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        //
        $callback = Callback::where('trx_id', '=', $request->transaksi_id)->first();
        $paket = Package::where('id', '=', $callback->package_id)->first();

        $total = $paket->total;

        $title = '[Confirmation] Terima kasih telah berkunjung';

        $print = ImagePrint::where('transaksi_id', '=', $request->transaksi_id)->get();

        if ($total != $print->count()) {
            return response()->json([
                'message' => 'Foto sedang proses diupload silahkan submit lagi setelah 5 menit',
                'desc' => 'Total data tidak sesuai dengan jumlah paket'
            ], 400);
        }

        foreach ($print as $dt) {
            $location = storage_path('app/public/images/list-contacts') . '/' . $dt->code . '/' . $dt->image_data;
            if (!File::exists($location)) {
                return response()->json([
                    'message' => 'Foto sedang proses diupload silahkan submit lagi setelah 5 menit',
                    'desc' => 'Foto tidak ada didalam folder'
                ], 400);
            }
        }

        $terakhir = ImagePrint::where('transaksi_id', '=', $request->transaksi_id)->first();

        $post = ListContact::create([
            'image_print_id' => $request->image_print_id,
            'transaksi_id' => $request->transaksi_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'code' => $terakhir->code,
            'booth_id' => $request->booth_id,
            'img_data' => $terakhir->img_data,
            'email' => $request->email,
            'kritik_saran' => $request->kritik_saran,
            'deleted_at' => Carbon::now()->addDays(1),
        ]);

        $post['img'] = ImagePrint::where('transaksi_id', '=', $request->transaksi_id)->orderBy('id', 'DESC')->get();
        if ($post) {
            $sendmail = Mail::to($post['email'])->send(new LinkDownload($title, $post));
            ImagePrint::where('transaksi_id', '=', $request->transaksi_id)->orderBy('id', 'DESC')->update(['status' => 'sended']);
            if (empty($sendmail)) {
                return response()->json(['message' => 'Mail Sent fail'], 400);
            } else {
                return response()->json(['message' => 'Mail Sent Successfully'], 200);
            }
        }
    }

    public function generate($id)
    {
        $data = ListContact::findOrFail($id);
        $qrcode = QrCode::size(400)->generate($location);
        // return view('qrcode', compact('qrcode'));
        return response($qrcode, Response::HTTP_ACCEPTED);
        // return response()->json($qrcode, 200);
    }
}
