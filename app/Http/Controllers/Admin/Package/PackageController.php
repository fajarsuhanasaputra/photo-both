<?php

namespace App\Http\Controllers\Admin\Package;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data['data'] = Package::first();
        // dd($data);
        if ($request->ajax()) {
            $data = Package::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '
                    <a href="'. route('package.show', $row->id) . '" class="show btn btn-primary btn-sm">View</a>
                    <form method="POST" action="' . route('package.destroy', ['package' => $row->id]) . '">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm package">
                            Delete
                        </button>
                    </form>
                ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.menu.package.list');
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
            'package_name' => ['unique:packages', 'required'],
            'price' => ['required'],
            'total' => ['required']
        ]);
        $data = new Package();
        $data->package_name = $request->package_name;
        $data->price = $request->price;
        $data->total = $request->total;
        $data->description = $request->description;
        $data->booth_id = 1;
        $data->save();
        alert()->success('Data Berhasil Ditambahkan', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect(route('package.index'))->with(['success' => 'Data has been Added !']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['data'] = Package::findOrFail($id);
        return view('backend.menu.package.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->validate($request, [
            'package_name' => ['required', Rule::unique('packages')->ignore($id)],
            'price' => ['required'],
            'total' => ['required']
        ]);
        $data = Package::find($id);
        $data->update([
            'package_name' => $request->package_name,
            'price' => $request->price,
            'total' => $request->total,
            'description' => $request->description
        ]);
        alert()->success('Data Berhasil Diubah', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect(route('package.index'))->with(['success' => 'Data has been Updated !']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Package::find($id);
        $data->delete();
        alert()->success('Data Berhasil Dihapus', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect(route('package.index'))->with(['success' => 'Data has been Deleted !']);
    }
}
