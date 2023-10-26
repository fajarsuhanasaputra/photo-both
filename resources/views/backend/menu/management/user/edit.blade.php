@extends('backend.template.master')

@section('sub-title')
- Edit Users
@stop

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('backend.template.flash', ['$errors' => $errors])
                <form id="RegisterValidation" action="{{ route("user.update", [$user->id]) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field()}}
                    {{ method_field('put') }}

                    <div class="card ">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">group</i>
                            </div>
                            <h4 class="card-title">Form Edit User</h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating"> Username *</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                                        @if($errors->has('name'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </em>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="email" class="bmd-label-floating"> Email *</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                                        @if($errors->has('email'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </em>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label for="password" class="bmd-label-floating"> Password *</label>
                                        <input type="password" name="password" class="form-control">
                                        @if($errors->has('password'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </em>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                                        <label for="password" class="bmd-label-floating"> Role *</label>
                                        <select name="roles[]" id="roles" class="form-control role" data-style="btn btn-success btn-round btn-sm" title="Select Role" required>
                                            @foreach($role as $id => $roles)
                                            <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles()->pluck('name', 'id')->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('roles'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('roles') }}
                                        </em>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm"><i class="material-icons">save</i> Save</button>
                            <a href="{{ route('user.index') }}" class="btn btn-sm btn-danger"><i class="material-icons">west</i> Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
