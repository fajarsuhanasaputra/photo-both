@extends('backend.template.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="text-right">
                    <button type="button" class="btn btn-round btn-success btn-sm" data-toggle="modal" data-target="#modalTambah">
                        <i class="material-icons">add_circle</i> Color
                    </button>
                </div>
                <div class="card">

                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">format_color_fill</i>
                        </div>
                        <h4 class="card-title">List Color</h4>
                    </div>
                    {{-- <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Hex Code</th>
                                        <th>Color</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Hex Code</th>
                                        <th>Color</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($data as $index=>$dt)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $dt->name }}</td>
                                        <td>{{ $dt->hex }}</td>
                                        <td><input type="color" value="{{ $dt->hex }}" disabled></td>
                                        <td class="text-right">
                                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalUpdate{{ $dt->id }}">
                                                <i class="material-icons">edit_square</i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete{{ $dt->id }}">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('backend.menu.master.color.modal-delete')
                                    @include('backend.menu.master.color.modal-edit')
                                    @endforeach
                                    @include('backend.menu.master.color.modal-add')
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                    <!-- end content-->
                </div>
                <!--  end card  -->
                <div class="card">
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="yajra-datatable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Hex</th>
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
            {{-- @include('backend.menu.master.color.modal-delete')
            @include('backend.menu.master.color.modal-edit') --}}
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
</div>
@stop
@push('scripts')
    <script type="text/javascript">
        $(function(){
            $('#yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('color.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'hex', name: 'hex' },
                    { data: 'action', name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endpush
