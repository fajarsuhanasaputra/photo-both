@extends('backend.template.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="loader-container" class="text-center">
                        <!-- Loader HTML -->
                        <img src="{{ asset('assets/img/Spinner-1s-200px.gif') }}" alt="Loader">
                        <p>Loading...</p>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">work</i>
                            </div>
                            <h4 class="card-title">List Booth</h4>
                        </div>
                        <div class="card-body">
                            <div class="material-datatables">
                                <table id="yajra-datatable" class="table table-striped table-no-bordered table-hover"
                                    cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>BOOTH-ID</th>
                                            <th>NAME</th>
                                            <th>ADDRESS</th>
                                            <th>INCOME</th>
                                            <th>CREATED</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        @include('errors.submit')
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
                ajax: "{{ route('booth.index') }}",
                language: {
                    "processing": ""
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'booth_id',
                        name: 'booth_id'
                    },
                    {
                        data: 'booth_name',
                        name: 'booth_name'
                    },
                    {
                        data: 'address',
                        name: 'address'
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
                        data: 'id', // Assuming 'id' is the key for identifying the row
                        render: function(data, type, row) {
                            var viewForm = '<a href="/booth/' + row.id +
                                '" class="edit btn btn-primary btn-sm"><i class="material-icons">info</i></a>';
                            return '<a href="/booth/' + row.id + '/edit' +
                                ' " class="edit btn btn-warning btn-sm"><i class="material-icons">edit_square</i></a>' +
                                viewForm;
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
