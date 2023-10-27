<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\Voucher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class VoucherController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Voucher::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '
                    <div class="text-right">
                        <a href="' . route('voucher.edit', $row->id) . '" class="edit  btn btn-warning btn-sm">
                            <i class="material-icons">edit_square</i>
                        </a>
                        <form method="POST" action="' . route('voucher.destroy', ['voucher' => $row->id]) . '" class="delete-form">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm  delete-voucher">
                                <i class="material-icons ">delete</i>
                            </button>
                        </form>
                    </div>
                    
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.menu.settings.voucher.list');
    }


    public function coupon(Request $request) {
        $coupon = Voucher::where('code', $request->code)->first();
        if (!$coupon) {
            return redirect()->back()->withErrors('Invalid coupon code. Please try again.');
        }
        $request->session()->put('coupon', [
            'name' => $coupon->code,
            'price' => $coupon->price,
        ]);

        alert()->success('Data Berhasil Ditambah', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect()->back()->with('success_message', 'Coupon has been applied!');
    }

    public function create(){
        return view('backend.menu.settings.voucher.add');
    }

    public function store(Request $request) {
        $request->validate([
            'code' => 'required',
            'value' => 'required',
            'start' => 'required',
            'expired' => 'required',
        ]);
        $data = new Voucher();
        $data->code = Str::upper($request->code);
        $data->type = $request->type = 'percent';
        $data->value = $request->value;
        $data->start = $request->start;
        $data->expired = $request->expired;
        $data->save();
        alert()->success('Data Berhasil Ditambah', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect(route('voucher.index'))->with(['success' => 'Data has been Added !']);
    }

    public function edit($id)
    {
        $data = Voucher::find($id);
        $view['data'] = $data;
        return view('backend.menu.settings.voucher.edit', $view);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'code' => 'required',
            'value' => 'required',
            'start' => 'required',
            'expired' => 'required',
        ]);

        $data = Voucher::find($id);
        $data->update([
            'code' => Str::upper($request->code),
            'value' => $request->value,
            'start' => $request->start,
            'expired' => $request->expired,
        ]);
        alert()->success('Data Berhasil Diubah', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect(route('voucher.index'))->with(['success' => 'Data has been Updated !']);
    }

    public function destroy($id) {
        $data = Voucher::find($id);
        $data->delete();
        alert()->success('Data Berhasil Dihapus', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return redirect(route('voucher.index'))->with(['success' => 'Data has been Deleted !']);
    }

}
