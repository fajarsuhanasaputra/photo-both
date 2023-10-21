<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Models\Gallery\GalleryImage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\ListContact;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactListsExport;
use Illuminate\Http\Request;

class ListContactsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['data'] = ListContact::join('booths', 'booths.id', '=', 'list_contacts.booth_id')
            ->orderBy('list_contacts.created_at', 'desc')
            ->select(
                'list_contacts.id',
                'list_contacts.image_print_id',
                'list_contacts.transaksi_id',
                'list_contacts.name',
                'list_contacts.phone',
                'list_contacts.email',
                'list_contacts.kritik_saran',
                'booths.booth_name',
                'list_contacts.created_at'
            )->get();
        return view('backend.menu.management.list-contacts.list', $data);
    }

    public function show($id)
    {
        $data['data'] = ListContact::join('booths', 'booths.id', '=', 'list_contacts.booth_id')
            ->select(
                'list_contacts.id',
                'list_contacts.image_print_id',
                'list_contacts.transaksi_id',
                'list_contacts.name',
                'list_contacts.phone',
                'list_contacts.email',
                'list_contacts.kritik_saran',
                'booths.booth_name',
                'list_contacts.created_at'
            )->where('list_contacts.id', '=', $id)
            ->first();
        return view('backend.menu.management.list-contacts.show', $data);
    }

    public function generate($id)
    {
        $data = ListContact::findOrFail($id);
        $qrcode = QrCode::size(400)->generate('http://localhost/boot/storage/app/public/images/gallery/' . $data->code . '/' . $data->img_data);
        return view('backend.menu.gallery.qrcode', compact('qrcode'));
    }

    public function destroy($id)
    {
        $news = ListContact::find($id);
        $path = storage_path('app/public/images/list-contacts') . '/' . $news->code . '/' . $news->img_data;
        if ($news->code == null) {
            $news->delete();
        } else {
            unlink($path);
        }
        $news->delete();
        //        alert()->success('Good Job', 'Successfully Deleted !!');
        alert()->success('Data Berhasil Dihapus', 'Successfully')->toToast()->timerProgressBar()->autoClose(2000);
        return back();
    }

    public function exportxls(Request $request)
    {
        $booth_name = $request->input('contact-booth', '');
        $tgl_start = $request->input('contact-start', '');
        $tgl_end = $request->input('contact-end', '');

        if ($booth_name == 'semua') {
            $booth_name = '';
        }
        $array = array($booth_name, $tgl_start, $tgl_end);
        return Excel::download(new ContactListsExport($array), 'contact_list.xlsx');
    }
}
