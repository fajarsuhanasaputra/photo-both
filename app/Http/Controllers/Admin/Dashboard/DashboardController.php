<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Callback;
use App\Models\ListContact;
use App\Models\Booth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $booth_name = $request->input('booth-select', '');
        $tgl_start = $request->input('tgl-start', '');
        $tgl_end = $request->input('tgl-end', '');

        if ($booth_name == 'semua') {
            $booth_name = '';
        }

        $pendapatan = Callback::where('status', 'COMPLETE')
            ->when($tgl_start, function ($query, $tgl_start) {
                $query->where('created_at', '>=', $tgl_start);
            })->when($tgl_end, function ($query, $tgl_end) {
                $query->where('created_at', '<=', $tgl_end . ' 23:59:59');
            })->when($booth_name, function ($query, $booth_name) {
                $query->where('booth_id', $booth_name);
            })->sum('amount');

        $view['pendapatan'] =  $pendapatan;

        $tot_trans = Callback::where('status', 'COMPLETE')
            ->when($tgl_start, function ($query, $tgl_start) {
                $query->where('created_at', '>=', $tgl_start);
            })->when($tgl_end, function ($query, $tgl_end) {
                $query->where('created_at', '<=', $tgl_end . ' 23:59:59');
            })->when($booth_name, function ($query, $booth_name) {
                $query->where('booth_id', $booth_name);
            })->count();

        $view['tot_trans'] = $tot_trans;

        $tot_form = ListContact::when($tgl_start, function ($query, $tgl_start) {
            $query->where('created_at', '>=', $tgl_start);
        })->when($tgl_end, function ($query, $tgl_end) {
            $query->where('created_at', '<=', $tgl_end . ' 23:59:59');
        })->when($booth_name, function ($query, $booth_name) {
            $query->where('booth_id', $booth_name);
        })->count();

        $view['tot_form'] = $tot_form;

        $chart = DB::table('callbacks')
            ->select(DB::raw("date(created_at) as tanggal"), DB::raw("sum(amount) as amount"))
            ->when($tgl_start, function ($query, $tgl_start) {
                $query->where('created_at', '>=', $tgl_start);
            })->when($tgl_end, function ($query, $tgl_end) {
                $query->where('created_at', '<=', $tgl_end . ' 23:59:59');
            })->when($booth_name, function ($query, $booth_name) {
                $query->where('booth_id', $booth_name);
            })->groupBy(DB::raw("date(created_at)"))
            ->where('status', 'COMPLETE')
            ->orderByRaw("date(created_at) desc")
            ->get();

        $booth = Booth::latest()->get();
        $view['booth'] = $booth;

        if ($booth_name == 'semua' || $booth_name == '') {
            $view['selected_booth'] = 'semua';
        } else {
            $view['selected_booth'] = $booth_name;
        }

        $view['tgl_start'] = $tgl_start;
        $view['tgl_end'] = $tgl_end;
        $view['chart'] = $chart;
        // dd($chart);
        return view('backend.menu.dashboard.dashboard', $view);
    }
}
