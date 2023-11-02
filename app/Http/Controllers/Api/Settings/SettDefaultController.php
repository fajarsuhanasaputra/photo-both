<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Models\SettingDefault;
use App\Models\Booth;

class SettDefaultController extends Controller
{

    public function index($id)
    {
        $data_blogs = Booth::find($id);
        $booth = new Booth;
        $data_blogs['img_background'] = $booth->getImgBgAttribute($data_blogs->id . '/' . $data_blogs->img_background);
        $data_blogs['img_background2'] = $booth->getImgBgAttribute($data_blogs->id . '/' . $data_blogs->img_background2);
        $data_blogs['img_background3'] = $booth->getImgBgAttribute($data_blogs->id . '/' . $data_blogs->img_background3);
        $data_blogs['img_logo'] = $booth->getImgLgAttribute($data_blogs->id . '/' . $data_blogs->img_logo);

        $data_blogs['pricing'] = $data_blogs['pricing'] === 'Default' ? false : true;

        return response()->json([
            'success' => true,
            'message' => 'List Setting Default',
            'data' => $data_blogs
        ], 200);
    }
}
