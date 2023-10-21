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
                            <i class="material-icons">percentage</i>
                        </div>
                        <h4 class="card-title">List Package</h4>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>PACKAGE NAME</th>
                                        <th>PRICE</th>
                                        <th>TOTAL</th>
                                        <th>DESCRIPTION</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>NO</th>
                                        <th>PACKAGE NAME</th>
                                        <th>PRICE</th>
                                        <th>TOTAL</th>
                                        <th>DESCRIPTION</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($data as $index=>$dt)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $dt->package_name }}</td>
                                        <td>@currency($dt->price)</td>
                                        <td>{{ $dt->total }} </td>
                                        <td>{{ $dt->description }} </td>
                                        <td class="text-right">
                                            <a href="{{ route('package.show', $dt->id) }}" class="btn btn-sm btn-primary">
                                                <i class="material-icons">info</i>
                                            </a>
                                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalUpdate{{ $dt->id }}">
                                                <i class="material-icons">edit_square</i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete{{ $dt->id }}">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('backend.menu.package.modal-delete')
                                    @include('backend.menu.package.modal-edit')
                                    @endforeach
                                    @include('backend.menu.package.modal-add')
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