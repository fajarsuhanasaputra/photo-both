@extends('backend.template.master')
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card ">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">map</i>
            </div>
            <h4 class="card-title">Detail Contact</h4>
          </div>
          <div class="card-body ">
            <div class="row">

              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label> TRANSACTION-ID </label>
                  <input type="text" disabled class="form-control" value="{{ $data->trx_id }}">

                </div>
              </div>

              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label> TOTAL</label>
                  <input type="text" disabled class="form-control" value="@currency($data->amount)">
                </div>
              </div>


              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label> PAGE</label>
                  <textarea disabled class="form-control">{{ $data->page }}</textarea>
                </div>
              </div>

              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label> STATUS</label>
                  <input type="text" disabled class="form-control" value="{{ $data->status }}">
                </div>
              </div>

            </div>
          </div>
          <div class="card-footer text-left">
            <a href="{{ route('transaction.index') }}" class="btn btn-sm btn-danger">
              <i class="material-icons">west</i> Kembali
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection