@extends('backend.template.master')

@section('sub-title')
- Add Users
@stop

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('backend.template.flash', ['$errors' => $errors])
                <form id="RegisterValidation" method="post" action="{{route('user.store')}}">
                    {{ csrf_field()}}
                    <div class="card ">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">group</i>
                            </div>
                            <h4 class="card-title">Form Add User</h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name" class="bmd-label-floating"> Username *</label>
                                        <input type="text" name="name" id="name" autocomplete="off" class="form-control" value="{{ old('name', isset($role) ? $role->name : '') }}" required>
                                        @if($errors->has('name'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </em>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                        <label for="exampleEmail" class="bmd-label-floating"> Email *</label>
                                        <input type="email" name="email" id="exampleEmail" autocomplete="off" class="form-control" value="{{ old('email', isset($role) ? $role->email : '') }}" required>
                                        @if($errors->has('email'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </em>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 mt-4">
                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label for="password" class="bmd-label-floating"> Password *</label>
                                        <input type="password" name="password" id="password" autocomplete="off" required class="form-control">
                                        @if($errors->has('password'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </em>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mt-4">
                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label for="password" class="bmd-label-floating"> Role *</label>
                                        <select name="roles[]" id="roles" class="form-control role" data-style="btn btn-success btn-round btn-sm" title="Select Role" required>
                                            @foreach($roles as $id => $roles)
                                            <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('password'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('password') }}
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
