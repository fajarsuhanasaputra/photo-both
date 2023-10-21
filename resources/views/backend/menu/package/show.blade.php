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
            <h4 class="card-title">Detail Paket</h4>
          </div>
          <div class="card-body ">
            <div class="row">

              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label> PACKAGE NAME </label><br>
                  <input type="text" disabled class="form-control" value="{{ $data->package_name }}">
                </div>
              </div>

              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label> PRICE </label><br>
                  <input type="text" disabled class="form-control" value="@currency($data->price)">

                </div>
              </div>

              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label> TOTAL </label><br>
                  <input type="text" disabled class="form-control" value="{{ $data->total }}">
                </div>
              </div>


              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label> DESCRIPTION </label><br>
                  <input type="text" disabled class="form-control" value="{{ $data->description }}">
                </div>
              </div>

              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label> DATE/TIME </label><br>
                  <input type="text" disabled class="form-control" value="{{ $data->created_at }}">
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer text-left">
            <a href="{{ route('package.index') }}" class="btn btn-sm btn-danger">
              <i class="material-icons">west</i> Kembali
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection