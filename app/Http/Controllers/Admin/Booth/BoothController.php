<?php

namespace App\Http\Controllers\Admin\Booth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Booth;
use App\Models\Callback;
use App\Models\Frame;
use App\Models\Package;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BoothController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['data'] = Booth::select(
            'booths.id',
            'booths.booth_id',
            'booths.booth_name',
            'booths.address',
            'booths.created_at',
            DB::raw("sum(callbacks.amount) as amount"),
        )
            ->leftjoin('callbacks', 'booths.id', '=', 'callbacks.booth_id')
            ->groupBy(DB::raw("booths.booth_id"))
            ->orderByRaw("booths.booth_id asc")
            ->get();

        return view('backend.menu.booth.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'booth_name' => ['unique:booths', 'required'],
            'booth_id' => ['unique:booths', 'required'],
        ]);
        $data = new Booth();
        $data->booth_id = $request->booth_id;
        $data->booth_name = $request->booth_name;
        $data->address = $request->address;
        $data->save();
        alert()->success('Data Berhasil Ditambahkan', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect(route('booth.index'))->with(['success' => 'Data has been Added !']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $view['awikwok'] = Booth::find($id);
        $data = Booth::select(
            'booths.id',
            'booths.booth_id',
            'booths.booth_name',
            'booths.address',
            'booths.created_at',
            'booths.frame',
            'booths.package',
            'booths.title',
            'booths.subtitle',
            'booths.img_logo',
            'booths.img_background',
            'booths.pricing',
            DB::raw("sum(callbacks.amount) as amount"),
        )->leftjoin('callbacks', 'booths.id', '=', 'callbacks.booth_id')
            ->groupBy(DB::raw("booths.booth_id"))
            ->orderByRaw("booths.booth_id asc")
            ->where('booths.id', '=', $id)
            ->first();

        $frame = explode(",", $data->frame);
        $package = explode(",", $data->package);

        $booth_frame = array();
        foreach ($frame as $fr) {
            $arr_frame = Frame::find($fr);
            array_push($booth_frame, $arr_frame);
        }

        $view['frame'] = $booth_frame;

        $booth_package = array();
        foreach ($package as $pg) {
            $arr_pg = Package::find($pg);
            array_push($booth_package, $arr_pg);
        }

        $view['package'] = $booth_package;
        $view['data'] = $data;

        $booth = new Booth;
        $view['data']['img_background'] = $booth->getImgBgAttribute($data->id . '/' . $data->img_background);
        $view['data']['img_logo'] = $booth->getImgLgAttribute($data->id . '/' . $data->img_logo);
        
        return view('backend.menu.booth.show', $view);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::all();
        $view['package'] = $package;

        $frame = Frame::all();
        $view['frame'] = $frame;

        $view['pricing'] = array('Default', 'Free Photobooth');

        $data = Booth::find($id);

        $view['booth_frame'] = explode(",", $data->frame);
        $view['booth_package'] = explode(",", $data->package);

        $view['data'] = $data;

        $booth = new Booth;
        $view['data']['img_background'] = $booth->getImgBgAttribute($data->id . '/' . $data->img_background);
        $view['data']['img_logo'] = $booth->getImgLgAttribute($data->id . '/' . $data->img_logo);
        
        return view('backend.menu.booth.edit', $view);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $frame = $request->frame ? implode(',', $request->frame) : '';
        $package = $request->package ? implode(',', $request->package) : '';
  
        $this->validate($request, [
            'booth_name' => ['required', Rule::unique('booths')->ignore($id)],
            // 'booth_id' => ['required', Rule::unique('booths')->ignore($request->booth_id)],
            'title' => 'required',
            'subtitle' => 'required',
            'img_background' => 'nullable|mimes:png,jpg,jpeg|max:10000',
            'img_logo' => 'nullable|mimes:png,jpg,jpeg|max:10000',
        ]);

        $data = Booth::find($id);
        $data->update([
            // 'booth_id' => $request->booth_id,
            'booth_name' => $request->booth_name,
            'address' => $request->address,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'pricing' => $request->pricing,
            'frame' => $frame,
            'package' => $package
        ]);

        $data->save();

        if ($request->hasFile('img_background')) {
            $photo = $request->file('img_background');
            $ext = strtolower($photo->getClientOriginalExtension());
            $image_full_name = Str::slug($request->title) . '.' . $ext;
            $location = storage_path('app/public/images/background') . '/' . $id . '/' . $image_full_name;
            Image::make($photo)->save($location);
            $data['img_background'] = $image_full_name;
            $data->save();
        }

        if ($request->hasFile('img_logo')) {
            $photo = $request->file('img_logo');
            $ext = strtolower($photo->getClientOriginalExtension());
            $image_full_name = 'logo' . '.' . $ext;
            $location = storage_path('app/public/images/logo') . '/' . $id . '/' . $image_full_name;
            Image::make($photo)->save($location);
            $data['img_logo'] = $image_full_name;
            $data->save();
        }

        alert()->success('Data Berhasil Diubah', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect(route('booth.index'))->with(['success' => 'Data has been Updated !']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Booth::find($id);
        $data->delete();
        alert()->success('Data Berhasil Dihapus', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect(route('booth.index'))->with(['success' => 'Data has been Deleted !']);
    }
}
