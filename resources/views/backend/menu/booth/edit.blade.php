@extends('backend.template.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('backend.template.flash', ['$errors' => $errors])
                    <form id="RegisterValidation" method="post" action="{{ route('booth.update', $data->id) }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="card ">
                            <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">settings_suggest</i>
                                </div>
                                <h4 class="card-title">Form Edit Booth</h4>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label for="booth_name" class="bmd-label-floating"> Booth Name*</label>
                                            <input type="text" name="booth_name" id="booth_name" required
                                                class="form-control" value="{{ $data->booth_name }}">
                                            @if ($errors->has('booth_name'))
                                                <em class="invalid-feedback">
                                                    {{ $errors->first('booth_name') }}
                                                </em>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="address" class="bmd-label-floating"> Address*</label>
                                            <input type="text" name="address" id="address" required
                                                class="form-control" value="{{ $data->address }}">
                                            @if ($errors->has('address'))
                                                <em class="invalid-feedback">
                                                    {{ $errors->first('address') }}
                                                </em>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="title" class="bmd-label-floating"> Title*</label>
                                            <input type="text" name="title" id="title" required
                                                class="form-control" value="{{ $data->title }}">
                                            @if ($errors->has('title'))
                                                <em class="invalid-feedback">
                                                    {{ $errors->first('title') }}
                                                </em>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="subtitle" class="bmd-label-floating"> Subtitle</label>
                                            <input type="text" name="subtitle" id="subtitle" class="form-control"
                                                value="{{ $data->subtitle }}">
                                            @if ($errors->has('subtitle'))
                                                <em class="invalid-feedback">
                                                    {{ $errors->first('subtitle') }}
                                                </em>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="subtitle" class="bmd-label-floating"> Pricing</label>
                                                    @foreach ($pricing as $pc)
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="radio"
                                                                    value="{{ $pc }}" name="pricing"
                                                                    {{ $data->pricing === $pc ? 'checked' : '' }}>
                                                                {{ $pc }}
                                                                <span class="circle">
                                                                    <span class="check"></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endforeach

                                                    <label for="subtitle" class="bmd-label-floating"> Retake</label>
                                                    @foreach ($retake as $rt)
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="radio"
                                                                    value="{{ $rt }}" name="retake"
                                                                    {{ $data->retake === $rt ? 'checked' : '' }}>
                                                                {{ $rt }}
                                                                <span class="circle">
                                                                    <span class="check"></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="subtitle" class="bmd-label-floating"> Frame</label>
                                                    @foreach ($frame as $fr)
                                                        <div class="ml-1 form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" name="frame[]"
                                                                    type="checkbox" value="{{ $fr->id }}"
                                                                    @foreach ($booth_frame as $i) @if ($fr->id == $i) checked @endif @endforeach>
                                                                {{ $fr->name }}
                                                                <span class="form-check-sign">
                                                                    <span class="check"></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="subtitle" class="bmd-label-floating"> Package</label>
                                                    @foreach ($package as $fr)
                                                        <div class="ml-1 form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" name="package[]"
                                                                    type="checkbox" value="{{ $fr->id }}"
                                                                    @foreach ($booth_package as $i) @if ($fr->id == $i) checked @endif @endforeach>
                                                                {{ $fr->package_name }}
                                                                <span class="form-check-sign">
                                                                    <span class="check"></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endforeach
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
                                                        <i class="material-icons">published_with_changes</i> Change
                                                        Background
                                                    </span>
                                                    <input type="file" name="img_background" />
                                                </span>
                                                <a href="#pablo" class="btn btn-sm btn-danger btn-round fileinput-exists"
                                                    data-dismiss="fileinput">
                                                    <i class="material-icons">delete</i> Remove
                                                </a>
                                            </div>
                                        </div>
                                        <label><b>Image Background 2</b></label>
                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                <img src="{{ $data->img_background2 }}" alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                            <div>
                                                <span class="btn btn-default btn-sm btn-round btn-file">
                                                    <span class="fileinput-new">Select Background</span>
                                                    <span class="fileinput-exists">
                                                        <i class="material-icons">published_with_changes</i> Change
                                                        Background
                                                    </span>
                                                    <input type="file" name="img_background" />
                                                </span>
                                                <a href="#pablo" class="btn btn-sm btn-danger btn-round fileinput-exists"
                                                    data-dismiss="fileinput">
                                                    <i class="material-icons">delete</i> Remove
                                                </a>
                                            </div>
                                        </div>
                                        <label><b>Image Background 3</b></label>
                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                <img src="{{ $data->img_background3 }}" alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                            <div>
                                                <span class="btn btn-default btn-sm btn-round btn-file">
                                                    <span class="fileinput-new">Select Background</span>
                                                    <span class="fileinput-exists">
                                                        <i class="material-icons">published_with_changes</i> Change
                                                        Background
                                                    </span>
                                                    <input type="file" name="img_background" />
                                                </span>
                                                <a href="#pablo" class="btn btn-sm btn-danger btn-round fileinput-exists"
                                                    data-dismiss="fileinput">
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
                                                <a href="#pablo" class="btn btn-sm btn-danger btn-round fileinput-exists"
                                                    data-dismiss="fileinput">
                                                    <i class="material-icons">delete</i> Remove
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="card-footer text-left">
                                    <a href="{{ route('booth.index') }}" class="btn btn-sm btn-danger">
                                        <i class="material-icons">west</i> Kembali
                                    </a>
                                </div>
                                <button type="submit" class="btn btn-success btn-sm"><i class="material-icons">save</i>
                                    Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
