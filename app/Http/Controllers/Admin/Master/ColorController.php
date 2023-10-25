<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\Color;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class ColorController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Color::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'. route('color.edit', $row->id).'" data-toggle="modal" data-target="#modalUpdate{{ $row->id }}" class="edit btn btn-primary btn-sm">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.menu.master.color.list');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'hex' => 'required',
        ]);
        $data = new Color();
        $data->name = $request->name;
        $data->hex = $request->hex;
        $data->save();
        alert()->success('Data Berhasil Ditambah', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect(route('color.index'))->with(['success' => 'Data has been Added !']);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
            'hex' => 'required',
        ]);

        $data = Color::find($id);
        $data->update([
            'name' => $request->name,
            'hex' => $request->hex,
        ]);
        alert()->success('Data Berhasil Diubah', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect(route('color.index'))->with(['success' => 'Data has been Updated !']);
    }

    public function destroy($id) {
        $data = Color::find($id);
        $data->delete();
        alert()->success('Data Berhasil Dihapus', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect(route('color.index'))->with(['success' => 'Data has been Deleted !']);
    }

}
