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
                                    @foreach($data as $index=>$dt)
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
                                    @endforeach
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