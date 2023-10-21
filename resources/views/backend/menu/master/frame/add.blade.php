@extends('backend.template.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('backend.template.flash', ['$errors' => $errors])
                <form id="RegisterValidation" method="post" action="{{route('frame.store')}}" enctype="multipart/form-data">
                    {{ csrf_field()}}
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">wallpaper</i>
                            </div>
                            <h4 class="card-title">Form Add Frame</h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleprice" class="bmd-label-floating"> Title*</label>
                                        <input type="text" name="name" id="exampleName" required class="form-control" value="{{ old('name') }}">
                                        @if($errors->has('name'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </em>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleName" class="bmd-label-floating"> Size*</label>
                                        <input type="text" name="size" id="exampleName" class="form-control" value="{{ old('size') }}">
                                        @if($errors->has('size'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('size') }}
                                        </em>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="orderNumber" class="bmd-label-floating"> Order Number*</label>
                                        <input type="number" name="order_number" id="orderNumber" required class="form-control" value="{{ old('order_number') }}">
                                        @if($errors->has('order_number'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('order_number') }}
                                        </em>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <label><b>Image Frame Left</b></label>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ (asset('storage/app/public/images/no-image.png')) }}" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-default btn-round btn-file btn-sm">
                                                <span class="fileinput-new">Select Image Frame</span>
                                                <span class="fileinput-exists">
                                                    <i class="material-icons">published_with_changes</i> Change Image
                                                </span>
                                                <input type="file" name="img_frame_left" />
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round btn-sm fileinput-exists" data-dismiss="fileinput">
                                                <i class="material-icons">delete</i> Remove
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <label><b>Image Frame Right</b></label>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ (asset('storage/app/public/images/no-image.png')) }}" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-default btn-round btn-file btn-sm">
                                                <span class="fileinput-new">Select Image Frame</span>
                                                <span class="fileinput-exists">
                                                    <i class="material-icons">published_with_changes</i> Change Image
                                                </span>
                                                <input type="file" name="img_frame_right" />
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round btn-sm fileinput-exists" data-dismiss="fileinput">
                                                <i class="material-icons">delete</i> Remove
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm"><i class="material-icons">save</i> Save</button>
                            <a href="{{ route('frame.index') }}" class="btn btn-sm btn-danger"><i class="material-icons">west</i> Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection