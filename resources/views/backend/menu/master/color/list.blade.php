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
                        <a href="{{ route('color.create') }}" class="btn btn-sm btn-round btn-success">
                            <i class="material-icons">add_circle</i> Color</a>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">format_color_fill</i>
                            </div>
                            <h4 class="card-title">List Color</h4>
                        </div>
                        <div class="card-body">
                            <div class="material-datatables">
                                <table id="yajra-datatable" class="table table-striped table-no-bordered table-hover"
                                    cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Hex</th>
                                            <th>Color</th>
                                            <th>Action</th>
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
                    Are you sure you want to delete this color?
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
        var table;
        $(function() {

            table = $('#yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('color.index') }}",
                language: {
                    "processing": ""
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'hex',
                        name: 'hex'
                    },
                    {
                        data: 'color',
                        name: 'color'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                initComplete: function(settings, json) {
                    $('#loader-container').hide(); // Hide the loader after DataTable is initialized
                    $('.material-datatables').show(); // Show the table after DataTable is initialized
                }
            });

            $('#yajra-datatable').on('click', '.delete-color', function(e) {
                e.preventDefault(); // Prevent the default form submission

                var deleteForm = $(this).closest('.delete-form');
                var deleteUrl = deleteForm.attr('action');

                $('#confirmDeleteModal').modal('show');

                // When the user confirms the delete, perform the delete action
                $('#confirmDelete').on('click', function() {
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
