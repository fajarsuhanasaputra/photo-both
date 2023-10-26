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
                ->addColumn('color', function($row){
                    $clr = '<input type="color" value="' . $row->hex . '" disabled>';
                    return $clr;
                })
                ->addColumn('action', function($row){
                    return '
                    <a href="'. route('color.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>
                    <form method="POST" action="' . route('color.destroy', ['color' => $row->id]) . '">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm delete-color">
                            Delete
                        </button>
                    </form>
                ';
                })
                ->rawColumns(['action', 'color']) // Added 'color' to rawColumns
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

    public function edit($id)
    {
        $data = Color::find($id);
        $view['data'] = $data;
        return view('backend.menu.master.color.edit', $view);
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
