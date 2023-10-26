@extends('backend.template.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-right">
                        <div class="text-right">
                            <a href="{{ route('frame.create') }}" class="btn btn-sm btn-round btn-success">
                                <i class="material-icons">add_circle</i> Image Frame</a>
                        </div>
                    </div>
                    {{-- <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">wallpaper</i>
                            </div>
                            <h4 class="card-title">List Frame</h4>
                        </div>
                        <div class="card-body">
                            <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                    cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Image Frame Left</th>
                                            <th>Image Frame Right</th>
                                            <th>Name</th>
                                            <th>Size</th>
                                            <th>Order Number</th>
                                            <th>Uploaded</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Image Frame Left</th>
                                            <th>Image Frame Right</th>
                                            <th>Name</th>
                                            <th>Size</th>
                                            <th>Order Number</th>
                                            <th>Uploaded</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($data as $dt)
                                        @php($i = 1)
                                            <tr id="i++">
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img src="{{ $dt->img_frame_left }}" alt="..." height="70px"
                                                        weight="70px"></td>
                                                <td><img src="{{ $dt->img_frame_right }}" alt="..." height="70px"
                                                        weight="70px"></td>
                                                <td>{{ $dt->name }}</td>
                                                <td>{{ $dt->size }}</td>
                                                <td>{{ $dt->order_number }}</td>
                                                <td>{{ $dt->created_at }} | {{ $dt->created_at->diffForHumans() }}</td>
                                                <td class="td-actions text-right">
                                                    <form action="{{ route('frame.destroy', $dt->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('frame.edit', $dt->id) }}"
                                                            class="btn btn-link btn-warning btn-just-icon edit">
                                                            <i class="material-icons">dvr</i>
                                                        </a>
                                                        <button class="btn btn-link btn-danger btn-just-icon remove"
                                                            onclick="return confirm('Are You Sure Delete This Data ?')">
                                                            <i class="material-icons">delete</i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">wallpaper</i>
                            </div>
                            <h4 class="card-title">List Frame</h4>
                        </div>
                        <div class="card-body">
                            <div class="material-datatables">
                                <table id="yajra-datatable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Image Frame Left</th>
                                            <th>Image Frame Right</th>
                                            <th>Name</th>
                                            <th>Size</th>
                                            <th>Order Number</th>
                                            <th>Uploaded</th>
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
        var table; // Define the table variable

        $(function(){
            table = $('#yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('frame.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'img_frame_left',
                        name: 'img_frame_left',
                        render: function( data, type, full, meta ) {
                            return "<img src=\"" + data + "\" height=\"50\"/>";
                        }
                    },
                    { data: 'img_frame_right',
                        name: 'img_frame_right',
                        render: function( data, type, full, meta ) {
                            return "<img src=\"" + data + "\" height=\"50\"/>";
                        }
                    },
                    { data: 'name', name: 'name' },
                    { data: 'size', name: 'size' },
                    { data: 'order_number', name: 'order_number' },
                    {
                        name: 'created_at.timestamp',
                        data: {
                            _: 'created_at.display',
                            sort: 'created_at.timestamp'
                        }
                    },
                    { data: 'action', name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#yajra-datatable').on('click', '.delete-frame', function () {
                var row = $(this).closest('tr');
                var frameId = table.row(row).data().id;

                if (confirm("Are you sure you want to delete this frame?")) {
                    $.ajax({
                        url: "{{ route('frame.destroy', ['frame' => 0]) }}".replace('0', frameId),
                        type: "POST",
                        data: {
                            "_method": 'DELETE',
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (data) {
                            table.ajax.reload();
                            alert(data.message); // Display the success message
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

