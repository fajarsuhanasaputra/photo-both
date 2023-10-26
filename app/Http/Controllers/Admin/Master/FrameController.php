<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\Booth;
use App\Models\Frame;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class FrameController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Frame::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <a href="'. route('frame.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>
                        <form method="POST" action="' . route('frame.destroy', ['frame' => $row->id]) . '">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm delete-frame">
                                Delete
                            </button>
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.menu.master.frame.list');
    }

    public function create()
    {
        $booth = Booth::latest()->get();
        $view['booth'] = $booth;
        return view('backend.menu.master.frame.add', $view);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'size' => 'required',
            'img_frame_left' => 'required|mimes:png,jpg,jpeg|max:10000',
            'img_frame_right' => 'required|mimes:png,jpg,jpeg|max:10000',
            'order_number' => ['unique:frames', 'required'],
        ]);
        $data = new Frame();
        $data->name = $request->name;
        $data->size = $request->size;
        $data->order_number = $request->order_number;
        $data->save();

        if ($request->hasFile('img_frame_left')) {
            $photo = $request->file('img_frame_left');
            $ext = strtolower($photo->getClientOriginalExtension());
            $image_full_name = Str::slug($request->name) . '-left' . '.' . $ext;
            $location = storage_path('app/public/images/frame') . '/' . $image_full_name;

            Image::make($photo)->save($location);
            $data['img_frame_left'] = $image_full_name;
            $data->save();
        }

        if ($request->hasFile('img_frame_right')) {
            $photo = $request->file('img_frame_right');
            $ext = strtolower($photo->getClientOriginalExtension());
            $image_full_name = Str::slug($request->name) . '-right' . '.' . $ext;
            $location = storage_path('app/public/images/frame') . '/' . $image_full_name;
            Image::make($photo)->save($location);
            $data['img_frame_right'] = $image_full_name;
            $data->save();
        }
        alert()->success('Data Berhasil Ditambah', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect(route('frame.index'))->with(['success' => 'Data has been Added !']);
    }

    public function edit($id)
    {
        $data = Frame::find($id);
        $view['data'] = $data;
        return view('backend.menu.master.frame.edit', $view);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'size' => 'required',
            'img_frame_right' => 'nullable|mimes:png,jpg,jpeg|max:10000',
            'img_frame_left' => 'nullable|mimes:png,jpg,jpeg|max:10000',
            'order_number' => ['required', Rule::unique('frames')->ignore($id)],
        ]);

        $data = Frame::find($id);
        $data->update([
            'name' => $request->name,
            'size' => $request->size,
            'order_number' => $request->order_number,
        ]);

        if ($request->hasFile('img_frame_left')) {
            $photo = $request->file('img_frame_left');
            $ext = strtolower($photo->getClientOriginalExtension());
            $image_full_name = Str::slug($request->name) . '-left' . '.' . $ext;
            $location = storage_path('app/public/images/frame') . '/' . $image_full_name;
            Image::make($photo)->save($location);
            $data['img_frame_left'] = $image_full_name;
            $data->save();
        }

        if ($request->hasFile('img_frame_right')) {
            $photo = $request->file('img_frame_right');
            $ext = strtolower($photo->getClientOriginalExtension());
            $image_full_name = Str::slug($request->name) . '-right' . '.' . $ext;
            $location = storage_path('app/public/images/frame') . '/' . $image_full_name;
            Image::make($photo)->save($location);
            $data['img_frame_right'] = $image_full_name;
            $data->save();
        }

        alert()->success('Data Berhasil Diubah', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect(route('frame.index'))->with(['success' => 'Data has been Updated !']);
    }

    public function destroy($id)
    {
        $news = Frame::find($id);
        //        $path = storage_path('app/public/images/frame') . '/' . $news->img_frame;
        //        if ($news->img_frame == null) {
        //            $news->delete();
        //        } else {
        //            unlink($path);
        //        }
        $news->delete();
        alert()->success('Good Job', 'Successfully Deleted !!');
        return back();
    }
}
