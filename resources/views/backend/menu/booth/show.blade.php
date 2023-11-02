@extends('backend.template.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">work</i>
                            </div>
                            <h4 class="card-title">Detail Booth</h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label> BOOTH ID </label><br>
                                        <input type="text" disabled class="form-control" value="{{ $data->booth_id }}">
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label> NAME </label><br>
                                        <input type="text" disabled class="form-control" value="{{ $data->booth_name }}">

                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label> ADDRESS </label><br>
                                        <input type="text" disabled class="form-control" value="{{ $data->address }}">
                                    </div>
                                </div>


                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label> TOTAL INCOME </label><br>
                                        <input type="text" disabled class="form-control" value="@currency($data->amount)">
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label> DATE/TIME </label><br>
                                        <input type="text" disabled class="form-control" value="{{ $data->created_at }}">
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label> PRICING </label><br>
                                        <input type="text" disabled class="form-control" value="{{ $data->pricing }}">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label> FRAME </label><br>
                                        <ol>
                                            @foreach ($frame as $fr)
                                                <li>{{ $fr->name }}</li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label> PACKAGE </label><br>
                                        <ol>
                                            @foreach ($package as $pg)
                                                <li>{{ $pg->package_name }}</li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <img src="{{ $data->img_background }}" alt="..." style="width:75%;"><br>
                                        <label>Image Background</label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <img src="{{ $data->img_logo }}" alt="..." style="width:75%;"><br>
                                        <label>Image Logo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <a href="{{ route('booth.index') }}" class="btn btn-sm btn-danger">
                                <i class="material-icons">west</i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
