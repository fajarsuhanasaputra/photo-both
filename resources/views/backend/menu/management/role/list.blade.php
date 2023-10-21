@extends('backend.template.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="text-right">
                    <a href="{{route('role.create')}}" class="btn btn-sm btn-round btn-success">
                        <i class="material-icons">add_circle</i> Role</a>
                </div>
                <div class="card">

                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">gavel</i>
                        </div>
                        <h4 class="card-title">List Roles</h4>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Permissions</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Permissions</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($roles as $index=>$dt)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $dt->name }}</td>
                                        <td>
                                            @foreach($dt->permissions()->pluck('name') as $permission)
                                            <span class="badge badge-info">{{ $permission }}</span>
                                            @endforeach
                                        </td>
                                        <td class="text-right">
                                            <form action="{{ route('role.destroy', $dt->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('role.edit', $dt->id) }}" class="btn btn-link btn-warning btn-just-icon edit" >
                                                    <i class="material-icons">dvr</i>
                                                </a>
                                                <button class="btn btn-link btn-danger btn-just-icon remove" onclick="return confirm('Are You Sure Delete This Data ?')"> 
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
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
</div>
@stop