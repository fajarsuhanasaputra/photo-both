@extends('backend.template.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="text-right">
                    <button type="button" class="btn btn-round btn-success btn-sm" data-toggle="modal" data-target="#modalTambah">
                        <i class="material-icons">add_circle</i> Data
                    </button>
                </div>
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">percent</i>
                        </div>
                        <h4 class="card-title">List Voucher</h4>
                    </div>
                    {{-- <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Start</th>
                                        <th>Expired</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Start</th>
                                        <th>Expired</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($data as $index=>$dt)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $dt->code }}</td>
                                        <td>{{ $dt->type }} </td>
                                        <td>{{ $dt->value }}%</td>
                                        <td>{{ \Carbon\Carbon::parse($dt->start)->format('d-m-Y')}}</td>
                                        <td>{{ \Carbon\Carbon::parse($dt->expired)->format('d-m-Y')}}</td>
                                        <td class="text-right">
                                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalUpdate{{ $dt->id }}">
                                                <i class="material-icons">edit_square</i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete{{ $dt->id }}">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('backend.menu.settings.voucher.modal-delete')
                                    @include('backend.menu.settings.voucher.modal-edit')
                                    @endforeach
                                    @include('backend.menu.settings.voucher.modal-add')
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="yajra-datatable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Start</th>
                                        <th>Expired</th>
                                        <th class="disabled-sorting text-right">Actions</th>
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
       $(function () {
            var table = $('#yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('voucher.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'code', name: 'code' },
                    { data: 'type', name: 'type' },
                    { data: 'value', name: 'value' },
                    { data: 'start', name: 'start' },
                    { data: 'expired', name: 'expired' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false, // Disable sorting for this column
                        searchable: false   // Disable searching for this column
                    },
                ]
            });

            $('#yajra-datatable').on('click', '.delete-voucher', function () {
                var row = $(this).closest('tr');
                var voucherId = table.row(row).data().id;

                if (confirm("Are you sure you want to delete this voucher?")) {
                    $.ajax({
                        url: "{{ route('voucher.destroy', ['voucher' => 0]) }}".replace('0', voucherId),
                        type: "POST",
                        data: {
                            "_method": 'DELETE',
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (data) {
                            table.ajax.reload();
                            alert(data.message); // You can replace this with a more user-friendly notification
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
        });
    </script>
@endpush
