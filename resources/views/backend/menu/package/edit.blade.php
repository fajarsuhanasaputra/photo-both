@extends('backend.template.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('backend.template.flash', ['$errors' => $errors])
                <form id="RegisterValidation" method="post" action="{{route('package.update', $data->id)}}" enctype="multipart/form-data">
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
                                        <label for="exampleprice" class="bmd-label-floating"> Package Name*</label>
                                        <input type="text" class="form-control" required name="package_name" value="{{ $data->package_name }}">
                                        @if($errors->has('package_name'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('package_name') }}
                                        </em>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleName" class="bmd-label-floating"> Price*</label>
                                        <input type="text" name="price" id="exampleName" class="form-control" value="{{ $data->price }}">
                                        @if($errors->has('price'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('price') }}
                                        </em>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleName" class="bmd-label-floating"> Total*</label>
                                        <input type="text" name="total" id="exampleName" class="form-control" value="{{ $data->total }}">
                                        @if($errors->has('total'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('total') }}
                                        </em>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleName" class="bmd-label-floating"> Description*</label>
                                        <textarea class="form-control" name="description">{{ $data->description }}</textarea>
                                        @if($errors->has('description'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('description') }}
                                        </em>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm"><i class="material-icons">save</i> Save</button>
                            <a href="{{ route('package.index') }}" class="btn btn-sm btn-danger"><i class="material-icons">west</i> Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
