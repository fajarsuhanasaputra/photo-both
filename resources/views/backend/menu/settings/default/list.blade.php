@extends('backend.template.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('backend.template.flash', ['$errors' => $errors])
                <form id="RegisterValidation" method="post" action="{{route('settings-default.update', $data->id)}}" enctype="multipart/form-data">
                    {{ csrf_field()}}
                    {{ method_field('put') }}
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">settings_suggest</i>
                            </div>
                            <h4 class="card-title">Form Setting Default</h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">

                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <label for="title" class="bmd-label-floating"> Title*</label>
                                        <input type="text" name="title" id="title" required class="form-control" value="{{ $data->title }}">
                                        @if($errors->has('title'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('title') }}
                                        </em>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="subtitle" class="bmd-label-floating"> Subtitle</label>
                                        <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ $data->subtitle }}">
                                        @if($errors->has('subtitle'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('subtitle') }}
                                        </em>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="price" class="bmd-label-floating"> Price (IDR)</label>
                                        <input type="text" name="price" id="price" class="number-separator form-control" value="{{ $data->price }}">
                                        @if($errors->has('price'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('price') }}
                                        </em>
                                        @endif
                                    </div>


                                    <div class="card ">
                                        <div class="card-header card-header-rose card-header-text">
                                            <h4 class="card-title">Free PhotoBooth</h4>
                                        </div>
                                        <div class="card-body ">

                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" value="isDefault" name="isDefault" {{ $data->isDefault == 'isDefault' ? 'checked' : '' }}> Default (<b>@currency($data->price)</b>)
                                                    <span class="circle">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" value="isFreePhotoBooth" name="isDefault" {{ $data->isDefault == 'isFreePhotoBooth' ? 'checked' : '' }}> Free Photo Booth
                                                    <span class="circle">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" value="Buy1Get1" name="isDefault" {{ $data->isDefault == 'Buy1Get1' ? 'checked' : '' }}> Buy 1 Get 1
                                                    <span class="circle">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-3">
                                    <label><b>Image Background</b></label>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ $data->img_background }}" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-default btn-sm btn-round btn-file">
                                                <span class="fileinput-new">Select Background</span>
                                                <span class="fileinput-exists">
                                                    <i class="material-icons">published_with_changes</i> Change Background
                                                </span>
                                                <input type="file" name="img_background" />
                                            </span>
                                            <a href="#pablo" class="btn btn-sm btn-danger btn-round fileinput-exists" data-dismiss="fileinput">
                                                <i class="material-icons">delete</i> Remove
                                            </a>
                                        </div>
                                    </div>

                                    <label><b>Logo</b></label>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ $data->img_logo }}" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-default btn-sm btn-round btn-file">
                                                <span class="fileinput-new">Select Logo</span>
                                                <span class="fileinput-exists">
                                                    <i class="material-icons">published_with_changes</i> Change Logo
                                                </span>
                                                <input type="file" name="img_logo" />
                                            </span>
                                            <a href="#pablo" class="btn btn-sm btn-danger btn-round fileinput-exists" data-dismiss="fileinput">
                                                <i class="material-icons">delete</i> Remove
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm"><i class="material-icons">save</i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection