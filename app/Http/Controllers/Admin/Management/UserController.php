<?php

namespace App\Http\Controllers\Admin\Management;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsersStoreRequest;
use App\Http\Requests\UsersUpdateRequest;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {

        if ($request->ajax()) {
            $data = User::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                    <a href="'. route('user.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>
                    <form method="POST" action="' . route('user.destroy', ['user' => $row->id]) . '">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm delete-user">
                            Delete
                        </button>
                    </form>
                ';
                })
                ->addColumn('role', function ($row) {
                    $roles = $row->roles->pluck('name')->toArray();
                    $badgeRoles = [];

                    foreach ($roles as $role) {
                        if ($role == 'Superadmin') {
                            $badgeRoles[] = '<span class="badge badge-info">' . $role . '</span>';
                        } else {
                            $badgeRoles[] = '<span class="badge badge-success">' . $role . '</span>';
                        }
                    }

                    return implode(' ', $badgeRoles);
                })
                ->rawColumns(['action', 'role'])
                ->make(true);
        }

        return view('backend.menu.management.user.list');
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
