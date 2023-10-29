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
                    <div class="text-right">
                        <form action="{{ route('list-contact-download') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-round btn-success btn-sm">
                                <i class="material-icons">download</i> download
                            </button>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">contact_mail</i>
                            </div>
                            <h4 class="card-title">List Forms</h4>
                        </div>
                        <div class="card-body">
                            <div class="material-datatables">
                                <table id="yajra-datatable" class="table table-striped table-no-bordered table-hover"
                                    cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Transaksi ID</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Kritik & Saran</th>
                                            <th>Booth Name</th>
                                            <th>Tanggal</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col-md-12 -->
            </div>
            <!-- end row -->
        </div>
    </div>
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this contact?
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
        $(function() {
            $('#yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('list-contact.index') }}",
                language: {
                    "processing": ""
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'transaksi_id',
                        name: 'list_contacts.transaksi_id'
                    },
                    {
                        data: 'name',
                        name: 'list_contacts.name'
                    },
                    {
                        data: 'phone',
                        name: 'list_contacts.phone'
                    },
                    {
                        data: 'email',
                        name: 'list_contacts.email'
                    },
                    {
                        data: 'kritik_saran',
                        name: 'list_contacts.kritik_saran'
                    },
                    {
                        data: 'booth_name',
                        name: 'booths.booth_name'
                    },
                    {
                        name: 'created_at.timestamp',
                        data: {
                            _: 'created_at.display',
                            sort: 'created_at.timestamp'
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            var deleteForm =
                                '<form method="POST" class="delete-form-render" action="' +
                                "{{ route('list-contact.destroy', ['list_contact' => ':id']) }}"
                                .replace(':id', row.id) + '">' +
                                '@csrf @method('DELETE')' +
                                '<button type="submit" class="btn btn-danger btn-sm delete-list-contact delete-contact"><i class="material-icons">delete</i></button></form>';
                            return '<a href="/list-contact/' + row.id +
                                '" class="edit btn btn-primary btn-sm"><i class="material-icons">info</i></a>' +
                                deleteForm;
                        }
                    },
                ],
                initComplete: function(settings, json) {
                    $('#loader-container').hide(); // Hide the loader after DataTable is initialized
                    $('.material-datatables').show(); // Show the table after DataTable is initialized
                }
            });

            $('#yajra-datatable').on('click', '.delete-contact', function(e) {
                e.preventDefault(); // Prevent the default form submission

                var deleteForm = $(this).closest('form'); // Correct the selector
                var deleteUrl = deleteForm.attr('action');

                $('#confirmDeleteModal').modal('show');

                // Attach a click event to the "Confirm Delete" button inside the modal
                $('#confirmDelete').off('click').on('click', function() {
                    deleteForm.submit(); // Submit the delete form
                    $('#confirmDeleteModal').modal('hide');
                });
            });

            // Close the modal when the user clicks "Cancel"
            $('#confirmDeleteModal').on('hidden.bs.modal', function() {
                $('#confirmDelete').off('click'); // Remove the click event to prevent multiple submissions
            });
        });
    </script>
@endpush
