<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\SettingDefault;
use Illuminate\Support\Str;

class SettDefaultController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $data ['data'] = SettingDefault::first();

        return view('backend.menu.settings.default.list', $data);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'img_background' => 'nullable|mimes:png,jpg,jpeg|max:10000',
            'img_background2' => 'nullable|mimes:png,jpg,jpeg|max:10000',
            'img_background3' => 'nullable|mimes:png,jpg,jpeg|max:10000',
            'img_logo' => 'nullable|mimes:png,jpg,jpeg|max:10000',
        ]);

        $data = SettingDefault::find($id);
        $data->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'isDefault' => $request->isDefault,
            'price' => str_replace(',', '', $request->price),
        ]);

//        if ($request->isFreePhoto == 'on') {
//            $data['isFreePhoto'] = true;
//        } elseif ($request->isFreePhoto == '') {
//            $data['isFreePhoto'] = false;
//        }
        $data->save();

        if ($request->hasFile('img_background')) {
            $photo = $request->file('img_background');
            $ext = strtolower($photo->getClientOriginalExtension());
            $image_full_name = Str::slug($request->title) . '.' . $ext;
            $location = storage_path('app/public/images/background') . '/' . $image_full_name;
            Image::make($photo)->save($location);
            $data['img_background'] = $image_full_name;
            $data->save();
        }
        if ($request->hasFile('img_background2')) {
            $photo = $request->file('img_background2');
            $ext = strtolower($photo->getClientOriginalExtension());
            $image_full_name = Str::slug($request->title) . '.' . $ext;
            $location = storage_path('app/public/images/background') . '/' . $image_full_name;
            Image::make($photo)->save($location);
            $data['img_background2'] = $image_full_name;
            $data->save();
        }
        if ($request->hasFile('img_background3')) {
            $photo = $request->file('img_background3');
            $ext = strtolower($photo->getClientOriginalExtension());
            $image_full_name = Str::slug($request->title) . '.' . $ext;
            $location = storage_path('app/public/images/background') . '/' . $image_full_name;
            Image::make($photo)->save($location);
            $data['img_background3'] = $image_full_name;
            $data->save();
        }

        if ($request->hasFile('img_logo')) {
            $photo = $request->file('img_logo');
            $ext = strtolower($photo->getClientOriginalExtension());
            $image_full_name = 'logo' . '.' . $ext;
            $location = storage_path('app/public/images/logo') . '/' . $image_full_name;
            Image::make($photo)->save($location);
            $data['img_logo'] = $image_full_name;
            $data->save();
        }

        alert()->success('Data Berhasil Diubah', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect()->back();
    }

}
