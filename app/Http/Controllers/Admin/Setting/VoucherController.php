<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Support\Str;

class VoucherController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $data ['data'] = Voucher::latest()->get();
        return view('backend.menu.settings.voucher.list', $data);
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
