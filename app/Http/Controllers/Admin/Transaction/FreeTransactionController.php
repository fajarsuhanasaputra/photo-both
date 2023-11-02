<?php

namespace App\Http\Controllers\Admin\Transaction;

use Carbon\Carbon;
use App\Models\Free;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class FreeTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $booth_name = $request->input('booth-select', '');
            $tgl_start = $request->input('tgl-start', '');
            $tgl_end = $request->input('tgl-end', '');

            if ($booth_name == 'semua') {
                $booth_name = '';
            }

            $data = Free::join('booths', 'free.booth_id', '=', 'booths.id')
                ->join('packages', 'free.package_id', '=', 'packages.id')
                ->select(
                    'free.id as DT_RowIndex',
                    'free.id',
                    'free.trx_id',
                    'booths.booth_name',
                    'packages.package_name',
                    'free.page',
                    'free.amount',
                    'free.created_at',
                    'free.updated_at',
                    'free.status',
                )->when($tgl_start, function ($query, $tgl_start) {
                    $query->where('free.created_at', '>=', $tgl_start);
                })->when($tgl_end, function ($query, $tgl_end) {
                    $query->where('free.created_at', '<=', $tgl_end . ' 23:59:59');
                })->when($booth_name, function ($query, $booth_name) {
                    $query->where('free.booth_id', $booth_name);
                })->orderBy('free.created_at', 'desc')
                ->get();

            $transformedData = $data->map(function ($item, $key) {
                return [
                    'DT_RowIndex' => $item->DT_RowIndex,
                    'id' => $item->id,
                    'trx_id' => $item->trx_id,
                    'booth_name' => $item->booth_name,
                    'package_name' => $item->package_name,
                    'page' => $item->page,
                    'amount' => $item->amount,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                    'status' => $item->status,
                ];
            });

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return [
                        'display' => Carbon::parse($row->created_at)->format('d-m-Y H:i:s'),
                        'timestamp' => $row->created_at->timestamp
                    ];
                })
                ->editColumn('updated_at', function ($row) {
                    return [
                        'display' => Carbon::parse($row->updated_at)->format('d-m-Y H:i:s'),
                        'timestamp' => $row->updated_at->timestamp
                    ];
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.menu.freetransaction.list');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
