<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $data ['roles'] = Role::all();
//        $view['data'] = $data;

        return view('backend.menu.management.role.list', $data);
    }

    public function create() {
        $permissions ['permissions'] = Permission::get()->pluck('name', 'name');
        return view('backend.menu.management.role.add', $permissions);
    }

    public function store(Request $request) {
        $role = Role::create($request->except('permission'));
        $permissions = $request->input('permission') ? $request->input('permission') : [];
        $role->givePermissionTo($permissions);
        alert()->success('Data Berhasil Ditambah', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect()->route('role.index');
    }

    public function edit(Role $role) {
        $permissions = Permission::get()->pluck('name', 'name');

        return view('backend.menu.management.role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role) {
        $role->update($request->except('permission'));
        $permissions = $request->input('permission') ? $request->input('permission') : [];
        $role->syncPermissions($permissions);

        alert()->success('Data Berhasil Diubah', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect()->route('role.index');
    }

    public function destroy(Role $role) {
        $role->delete();

        alert()->success('Data Berhasil Dihapus', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect()->route('role.index');
    }

}
