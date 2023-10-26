@extends('backend.template.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('backend.template.flash', ['$errors' => $errors])
                <form id="RegisterValidation" method="post" action="{{route('voucher.update', $data->id)}}" enctype="multipart/form-data">
                    {{ csrf_field()}}
                    {{ method_field('put') }}
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">wallpaper</i>
                            </div>
                            <h4 class="card-title">Form Edit Color</h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleprice" class="bmd-label-floating"> Type*</label>
                                        <input type="text" class="form-control" required name="type" value="{{ $data->type }}">
                                        @if($errors->has('type'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('type') }}
                                        </em>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleName" class="bmd-label-floating"> Code*</label>
                                        <input type="text" name="code" id="exampleName" class="form-control" value="{{ $data->code }}">
                                        @if($errors->has('code'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('code') }}
                                        </em>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleName" class="bmd-label-floating"> Value*</label>
                                        <input type="number" name="value" id="exampleName" class="form-control" value="{{ $data->value }}">
                                        @if($errors->has('value'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('value') }}
                                        </em>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleName" class="bmd-label-floating"> Start*</label>
                                        <input type="date" name="start" id="exampleName" class="form-control" value="{{ $data->start }}">
                                        @if($errors->has('start'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('start') }}
                                        </em>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleName" class="bmd-label-floating"> Expired*</label>
                                        <input type="date" name="expired" id="exampleName" class="form-control" value="{{ $data->expired }}">
                                        @if($errors->has('expired'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('expired') }}
                                        </em>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm"><i class="material-icons">save</i> Save</button>
                            <a href="{{ route('voucher.index') }}" class="btn btn-sm btn-danger"><i class="material-icons">west</i> Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
