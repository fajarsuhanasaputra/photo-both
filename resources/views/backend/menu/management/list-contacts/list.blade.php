@extends('backend.template.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="text-right">
                    <form action="{{ route('list-contact-download') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-round btn-success btn-sm">
                            <i class="material-icons">download</i> donwload
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
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Transaksi ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Tanggal</th>
                                        <th>Nama Booth</th>
                                        <th>Kritik & Saran</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Transaksi ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Tanggal</th>
                                        <th>Nama Booth</th>
                                        <th>Kritik & Saran</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    {{-- @foreach($data as $index=>$dt)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $dt->transaksi_id }}</td>
                                        <td>{{ $dt->name }}</td>
                                        <td>{{ $dt->email }}</td>
                                        <td>{{ $dt->phone }}</td>
                                        <td>{{ $dt->created_at }} | {{ ($dt->created_at)->diffForHumans() }}</td>
                                        <td>{{ $dt->booth_name }}</td>
                                        <td>{{ $dt->kritik_saran }}</td>
                                        <td class="td-actions text-right">
                                            <form action="{{ route('list-contact.destroy', $dt->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('list-contact.show', $dt->id) }}" class="btn btn-link btn-warning btn-just-icon edit">
                                                    <i class="material-icons">info</i>
                                                </a>
                                                <button class="btn btn-link btn-danger btn-just-icon remove" onclick="return confirm('Are You Sure Delete This Data ?')">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
                <div class="card">
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="yajra-datatable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Transaksi ID</th>
                                        <th>Image Print ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Code</th>
                                        <th>Img Data</th>
                                        <th>Booth Id</th>
                                        <th>Kritik & Saran</th>
                                        <th>Tanggal</th>
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
@stop
@push('scripts')
    <script type="text/javascript">
        $(function(){
            $('#yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('list-contact.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'transaksi_id', name: 'transaksi_id' },
                    { data: 'image_print_id', name: 'image_print_id' },
                    { data: 'name', name: 'name' },
                    { data: 'phone', name: 'phone' },
                    { data: 'email', name: 'email' },
                    { data: 'code', name: 'code' },
                    { data: 'img_data', name: 'img_data' },
                    { data: 'booth_id', name: 'booth_id' },
                    { data: 'kritik_saran', name: 'kritik_saran' },
                    { data: 'created_at', name: 'created_at' },


                ]
            });
        });
    </script>
@endpush
