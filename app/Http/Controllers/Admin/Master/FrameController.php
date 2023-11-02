<?php

namespace App\Http\Controllers\Admin\Master;

use Carbon\Carbon;
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
                    <div class="text-right">
                        <a href="' . route('frame.edit', $row->id) . '" class="edit btn btn-warning btn-sm">
                            <i class="material-icons">edit_square</i>
                        </a>
                        <form method="POST" action="' . route('frame.destroy', ['frame' => $row->id]) . '" class="delete-form">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm delete-frame">
                                <i class="material-icons">delete</i>
                            </button>
                        </form>
                    </div>
                    ';
                })
                ->rawColumns(['action'])
                ->editColumn('created_at', function ($row) {
                    return [
                        'display' => Carbon::parse($row->created_at)->format('d-m-Y H:i:s'),
                        'timestamp' => $row->created_at->timestamp
                    ];
                })
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
            'img_frame_left' => 'mimes:png,jpg,jpeg|max:10000',
            'img_frame_right' => 'mimes:png,jpg,jpeg|max:10000',
            'order_number' => 'required',
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
            'order_number' => 'required',
        ]);

        $data = Frame::find($id);

        $newOrderNumber = $request->order_number;

        // Check if the order number is being updated
        if ($data->order_number != $newOrderNumber) {
            if ($newOrderNumber < $data->order_number) {
                $framesToShift = Frame::where('order_number', '>=', $newOrderNumber)
                    ->where('order_number', '<', $data->order_number)
                    ->where('id', '!=', $id)
                    ->orderBy('order_number')
                    ->get();

                // Shifting order numbers for frames between the new order number and the old order number
                foreach ($framesToShift as $frame) {
                    $frame->order_number += 1;
                    $frame->save();
                }
            } else {
                $framesToShift = Frame::where('order_number', '>', $data->order_number)
                    ->where('order_number', '<=', $newOrderNumber)
                    ->where('id', '!=', $id)
                    ->orderBy('order_number')
                    ->get();

                // Shifting order numbers for frames between the old order number and the new order number
                foreach ($framesToShift as $frame) {
                    $frame->order_number -= 1;
                    $frame->save();
                }
            }

            $data->order_number = $newOrderNumber;
            $data->name = $request->name;
            $data->size = $request->size;
            $data->save();
        } else {
            // If the order number is not being changed, update the name and size
            $data->name = $request->name;
            $data->size = $request->size;
            $data->save();
        }

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
