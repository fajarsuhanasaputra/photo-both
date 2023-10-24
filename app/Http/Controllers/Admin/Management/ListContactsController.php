<?php

namespace App\Http\Controllers\Admin\Management;

use App\Models\ListContact;
//use Illuminate\Http\Request;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Exports\ContactListsExport;
use App\Http\Controllers\Controller;
use App\Models\Gallery\GalleryImage;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ListContactsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
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
        //     dd($data);
        // if ($request->ajax()) {
        //     $data = ListContact::join('booths', 'booths.id', '=', 'list_contacts.booth_id')
        //         ->orderBy('list_contacts.created_at', 'desc')
        //         ->select(
        //             'list_contacts.id as DT_RowIndex',
        //             'list_contacts.image_print_id',
        //             'list_contacts.transaksi_id',
        //             'list_contacts.name',
        //             'list_contacts.phone',
        //             'list_contacts.email',
        //             'list_contacts.kritik_saran',
        //             'booths.booth_name',
        //             'list_contacts.created_at'
        //         )->get();

        //     $transformedData = $data->map(function ($item, $key) {
        //         return [
        //             'DT_RowIndex' => $item->DT_RowIndex,
        //             'image_print_id' => $item->image_print_id,
        //             'transaksi_id' => $item->transaksi_id,
        //             'name' => $item->name,
        //             'phone' => $item->phone,
        //             'email' => $item->email,
        //             'kritik_saran' => $item->kritik_saran,
        //             'booth_name' => $item->booth_name,
        //             'created_at' => $item->created_at,
        //         ];
        //     });
        //     return DataTables::of($data)
        //         ->addIndexColumn()

        //         ->rawColumns(['action'])
        //         ->make(true);
        //     }
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
