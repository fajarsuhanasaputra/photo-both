@extends('backend.template.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        {{-- <form method="post" action="{{route('transaction.store')}}">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="material-icons">refresh</i> Refresh
                    </button>
                </div>
            </div>
        </form> --}}
        <div class="row">
            <div class="col-md-12">
                {{-- <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">receipt</i>
                        </div>
                        <h4 class="card-title">User Tracking / Transaksi</h4>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>TRANSACTION-ID</th>
                                        <th>BOOTH</th>
                                        <th>PAKET</th>
                                        <th>TOTAL</th>
                                        <th>DATE/TIME CREATED</th>
                                        <th>PAGE</th>
                                        <th>DATE/TIME UPDATED</th>
                                        <th>STATUS</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>NO</th>
                                        <th>TRANSACTION-ID</th>
                                        <th>BOOTH</th>
                                        <th>PAKET</th>
                                        <th>TOTAL</th>
                                        <th>DATE/TIME CREATED</th>
                                        <th>PAGE</th>
                                        <th>DATE/TIME UPDATED</th>
                                        <th>STATUS</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($data as $index=>$dt)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dt->trx_id }} </td>
                                        <td>{{ $dt->booth_name }}</td>
                                        <td>{{ $dt->package_name }}</td>
                                        <td>@currency($dt->amount)</td>
                                        <td>{{ $dt->created_at }}</td>
                                        <td>{{ $dt->page }}</td>
                                        <td>{{ $dt->updated_at }}</td>
                                        <td>{{ $dt->status }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('transaction.show', $dt->id) }}" class="btn btn-sm btn-primary">
                                                <i class="material-icons">info</i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
                <div class="text-center">
                    @include('errors.submit')
                </div>
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">receipt</i>
                        </div>
                        <h4 class="card-title">User Tracking / Transaksi</h4>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="yajra-datatable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>TRANSACTION-ID</th>
                                        <th>BOOTH</th>
                                        <th>PAKET</th>
                                        <th>PAGE</th>
                                        <th>TOTAL</th>
                                        <th>DATE/TIME CREATED</th>
                                        <th>DATE/TIME UPDATED</th>
                                        <th>STATUS</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function onStartChange() {
        var start = document.getElementById("tgl-start").value;
        document.getElementById("tgl-end").setAttribute("min", start);
    }

    function onEndChange() {
        var end = document.getElementById("tgl-end").value;
        document.getElementById("tgl-start").setAttribute("max", end);
    }
</script>
@stop
@push('scripts')
    <script type="text/javascript">
        function formatCurrency(amount) {
            return numeral(amount).format('IDR 0,0.00');
        }

        $(function(){
            $('#yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('transaction.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'trx_id', name: 'trx_id' },
                    { data: 'booth_name', name: 'booth_name' },
                    { data: 'package_name', name: 'package_name' },
                    { data: 'page', name: 'page' },
                    { data: 'amount', name: 'amount',
                            render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' )
                    },
                    {
                        name: 'created_at.timestamp',
                        data: {
                            _: 'created_at.display',
                            sort: 'created_at.timestamp'
                        }
                    },
                    {
                        name: 'updated_at.timestamp',
                        data: {
                            _: 'updated_at.display',
                            sort: 'updated_at.timestamp'
                        }
                    },
                    { data: 'status', name: 'status' },
                    {
                        data: '',
                        name: '',
                        render: (data, type, row) => {
                            return `<a href="/transaction/${row.id}" class="edit btn btn-primary btn-sm"><i class="material-icons">info</i></a>`
                        }
                    },
                ]
            });
        });
    </script>
@endpush
