@extends('backend.template.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="text-right">
                    <a href="{{ route('voucher.create') }}" class="btn btn-sm btn-round btn-success">
                        <i class="material-icons">add_circle</i> Voucher</a>
                </div>
                {{-- <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">percent</i>
                        </div>
                        <h4 class="card-title">List Voucher</h4>
                    </div>
                    <div class="card-body">
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
                    </div>
                </div> --}}
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">percent</i>
                        </div>
                        <h4 class="card-title">List Voucher</h4>
                    </div>
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
<!-- Add this modal HTML at the top of your view -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this voucher?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
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

            $('#yajra-datatable').on('click', '.delete-voucher', function (e) {
                e.preventDefault(); // Prevent the default form submission

                var deleteForm = $(this).closest('.delete-form');
                var deleteUrl = deleteForm.attr('action');

                $('#confirmDeleteModal').modal('show');

                // When the user confirms the delete, perform the delete action
                $('#confirmDelete').on('click', function () {
                    deleteForm.submit(); // Submit the delete form
                    $('#confirmDeleteModal').modal('hide');
                });
            });

            // Close the modal when the user clicks "Cancel"
            $('#confirmDeleteModal').on('hidden.bs.modal', function () {
                $('#confirmDelete').off('click'); // Remove the click event to prevent multiple submissions
            });
        });
    </script>
@endpush
