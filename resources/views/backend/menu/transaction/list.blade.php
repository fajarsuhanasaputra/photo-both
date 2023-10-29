@extends('backend.template.master')
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        @include('errors.submit')
                    </div>
                    <div id="loader-container" class="text-center">
                        <!-- Loader HTML -->
                        <img src="{{ asset('assets/img/Spinner-1s-200px.gif') }}" alt="Loader">
                        <p>Loading...</p>
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
                                <table id="yajra-datatable" class="table table-striped table-no-bordered table-hover"
                                    cellspacing="0" width="100%">
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
@stop
@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('transaction.index') }}",
                language: {
                    "processing": ""
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'trx_id',
                        name: 'trx_id'
                    },
                    {
                        data: 'booth_name',
                        name: 'booth_name'
                    },
                    {
                        data: 'package_name',
                        name: 'package_name'
                    },
                    {
                        data: 'page',
                        name: 'page'
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
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
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: '',
                        name: '',
                        render: (data, type, row) => {
                            return `<a href="/transaction/${row.id}" class="edit btn btn-primary btn-sm"><i class="material-icons">info</i></a>`
                        }
                    },

                ],
                initComplete: function(settings, json) {
                    $('#loader-container').hide(); // Hide the loader after DataTable is initialized
                    $('.material-datatables').show(); // Show the table after DataTable is initialized
                }
            });

        });
    </script>
@endpush
