<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UsersUpdateRequest;
use App\Http\Requests\UsersStoreRequest;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $data ['users'] = User::all();

        return view('backend.menu.management.user.list', $data);
    }

    public function create() {
        $roles ['roles'] = Role::get()->pluck('name', 'name');
        return view('backend.menu.management.user.add', $roles);
    }

    public function store(UsersStoreRequest $request) {
        $user = User::create($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->assignRole($roles);
        alert()->success('Data Berhasil Ditambah', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect()->route('user.index');
    }

    public function edit(User $user) {
        $role = Role::get()->pluck('name', 'name');
        return view('backend.menu.management.user.edit', compact('user', 'role'));
    }

    public function update(UsersUpdateRequest $request, User $user) {

        $user->update($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);
        alert()->success('Data Berhasil Diubah', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect()->route('user.index');
    }

    public function destroy(User $user) {
        $user->delete();
        alert()->success('Data Berhasil Dihapus', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect()->route('user.index');
    }

}
