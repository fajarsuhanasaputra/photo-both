@extends('backend.template.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">work</i>
                        </div>
                        <h4 class="card-title">List Booth</h4>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
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
                                <tfoot>
                                    <tr>
                                        <th>NO</th>
                                        <th>BOOTH-ID</th>
                                        <th>NAME</th>
                                        <th>ADDRESS</th>
                                        <th>INCOME</th>
                                        <th>CREATED</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    {{-- @foreach($data as $index=>$dt)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $dt->booth_id }}</td>
                                        <td>{{ $dt->booth_name }}</td>
                                        <td>{{ $dt->address }} </td>
                                        <td>@currency($dt->amount)</td>
                                        <td>{{ \Carbon\Carbon::parse($dt->created_at)->format('d-m-Y')}}</td>
                                        <td class="text-right">
                                            <a href="{{ route('booth.show', $dt->id) }}" class="btn btn-sm btn-primary">
                                                <i class="material-icons">info</i>
                                            </a>
                                            <a href="{{ route('booth.edit', $dt->id) }}" class="btn btn-sm btn-warning">
                                                <i class="material-icons">edit_square</i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card">
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
        $(function(){
            $('#yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('booth.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'booth_id', name: 'booth_id' },
                    { data: 'booth_name', name: 'booth_name' },
                    { data: 'address', name: 'address' },
                    { data: 'amount', name: 'amount' },
                    { data: 'created_at', name: 'created_at' },
                    {
                        data: 'id', // Assuming 'id' is the key for identifying the row
                        render: function (data, type, row) {
                            var deleteForm = '<form method="POST" action="' + "{{ route('booth.destroy', ['booth' => ':id']) }}".replace(':id', row.id) + '">' +
                                '@csrf @method("DELETE")' +
                                '<button type="submit" class="btn btn-danger btn-sm delete-booth" onclick="return confirm(\'Are you sure you want to delete this booth?\')">Delete</button></form>';
                            return '<a href="/booth/' + row.id + '" class="edit btn btn-primary btn-sm">View</a>' + deleteForm;
                        }
                    },
                ]
            });
        });
    </script>
@endpush
