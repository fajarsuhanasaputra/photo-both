@extends('backend.template.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">folder_shared</i>
                        </div>
                        <h4 class="card-title">Detail Guests</h4>
                    </div>
                    <div class="card-body ">
                        <div class="row">

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label> Nama </label>
                                    <input type="text" disabled class="form-control" value="{{ $data->name }}">

                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label> Phone </label>
                                    <input type="text" disabled class="form-control" value="{{ $data->phone }}">

                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label> Alamat E-mail </label>
                                    <input type="email" disabled class="form-control" value="{{ $data->email }}">
                                </div>
                            </div>


                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label> Isi pesan </label><br>
                                    <textarea  type="text" disabled class="form-control" rows="4"> {{ $data->kritik_saran }} </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <a href="{{ route('list-guest.index') }}" class="btn btn-sm btn-danger">
                            <i class="material-icons">west</i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection