<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Controller;
use App\Models\ListGuest;

class ListGuestController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $data['data'] = ListGuest::all();
        return view('backend.menu.management.list-guests.list', $data);
    }

    public function show($id) {
        $data['data'] = ListGuest::find($id);
        return view('backend.menu.management.list-guests.show', $data);
    }

//    public function generate($id) {
//        $data = GalleryImage::findOrFail($id);
//        $qrcode = QrCode::size(400)->generate('http://localhost/boot/storage/app/public/images/gallery/' . $data->code . '/' . $data->img_data);
//        return view('backend.menu.gallery.qrcode', compact('qrcode'));
//    }

    public function destroy($id) {
        $news = ListGuest::find($id);
//        $path = storage_path('app/public/images/gallery') . '/' . $news->code . '/' . $news->img_data;
//        if ($news->code == null) {
//            $news->delete();
//        } else {
//            unlink($path);
//        }
        $news->delete();
        alert()->success('Good Job', 'Successfully Deleted !!');
        return back();
    }

}
