<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $data = Color::all();
        $view['data'] = $data;

        return view('backend.menu.master.color.list', $view);
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
