<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $data = Permission::all();
        $view['data'] = $data;

        return view('backend.menu.management.permission.list', $view);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
        ]);
        $data = new Permission();
        $data->name = $request->name;
        $data->save();
        alert()->success('Data Berhasil Ditambah', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect(route('permission.index'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $data = Permission::find($id);
        $data->update([
            'name' => $request->name,
        ]);
        alert()->success('Data Berhasil Diubah', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect(route('permission.index'));
    }

    public function destroy($id) {
        $data = Permission::find($id);
        $data->delete();
        alert()->success('Data Berhasil Dihapus', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);

        return redirect(route('permission.index'));
    }

}
