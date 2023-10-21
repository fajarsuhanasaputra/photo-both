<?php

namespace App\Http\Controllers\Admin\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Callback;
use App\Models\Booth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $booth_name = $request->input('booth-select', '');
        $tgl_start = $request->input('tgl-start', '');
        $tgl_end = $request->input('tgl-end', '');

        if ($booth_name == 'semua') {
            $booth_name = '';
        }

        $data['data'] = Callback::join('booths', 'callbacks.booth_id', '=', 'booths.id')
            ->join('packages', 'callbacks.package_id', '=', 'packages.id')
            ->select(
                'callbacks.id',
                'callbacks.trx_id',
                'booths.booth_name',
                'packages.package_name',
                'callbacks.page',
                'callbacks.amount',
                'callbacks.created_at',
                'callbacks.updated_at',
                'callbacks.status',
            )->when($tgl_start, function ($query, $tgl_start) {
                $query->where('callbacks.created_at', '>=', $tgl_start);
            })->when($tgl_end, function ($query, $tgl_end) {
                $query->where('callbacks.created_at', '<=', $tgl_end . ' 23:59:59');
            })->when($booth_name, function ($query, $booth_name) {
                $query->where('callbacks.booth_id', $booth_name);
            })->orderBy('callbacks.created_at', 'desc')
            ->get();

        $booth = Booth::latest()->get();
        $data['booth'] = $booth;

        if ($booth_name == 'semua' || $booth_name == '') {
            $data['selected_booth'] = 'semua';
        } else {
            $data['selected_booth'] = $booth_name;
        }

        $data['tgl_start'] = $tgl_start;
        $data['tgl_end'] = $tgl_end;

        return view('backend.menu.transaction.list', $data);
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
        $booth_name = $request->input('booth-select', '');
        $tgl_start = $request->input('tgl-start', '');
        $tgl_end = $request->input('tgl-end', '');

        if ($booth_name == 'semua') {
            $booth_name = '';
        }

        $data['data'] = Callback::join('booths', 'callbacks.booth_id', '=', 'booths.id')
            ->join('packages', 'callbacks.package_id', '=', 'packages.id')
            ->select(
                'callbacks.id',
                'callbacks.trx_id',
                'booths.booth_name',
                'packages.package_name',
                'callbacks.page',
                'callbacks.amount',
                'callbacks.created_at',
                'callbacks.updated_at',
                'callbacks.status',
            )->when($tgl_start, function ($query, $tgl_start) {
                $query->where('callbacks.created_at', '>=', $tgl_start);
            })->when($tgl_end, function ($query, $tgl_end) {
                $query->where('callbacks.created_at', '<=', $tgl_end . ' 23:59:59');
            })->when($booth_name, function ($query, $booth_name) {
                $query->where('callbacks.booth_id', $booth_name);
            })->orderBy('callbacks.updated_at', 'desc')
            ->get();

        $booth = Booth::latest()->get();
        $data['booth'] = $booth;

        if ($booth_name == 'semua' || $booth_name == '') {
            $data['selected_booth'] = 'semua';
        } else {
            $data['selected_booth'] = $booth_name;
        }

        $data['tgl_start'] = $tgl_start;
        $data['tgl_end'] = $tgl_end;

        return view('backend.menu.transaction.list', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['data'] = Callback::find($id);
        return view('backend.menu.transaction.show', $data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
