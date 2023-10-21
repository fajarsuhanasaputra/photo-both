@extends('backend.template.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('backend.template.flash', ['$errors' => $errors])
                <form id="RegisterValidation" method="post" action="{{route('role.store')}}">
                    {{ csrf_field()}}
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">gavel</i>
                            </div>
                            <h4 class="card-title">Form Add Role</h4>
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


                                </div>
                                <div class="col-md-6 col-sm-12 mt-1">
                                    <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                                        <label for="name" class="bmd-label-floating">{{ trans('Permissions') }}*
                                            <br>
                                            <select id="permission" class="selectpicker" name="permission[]" data-style="btn btn-success btn-round btn-sm" title="Select Permissions" multiple="multiple" required>
                                                @foreach($permissions as $id => $permissions)
                                                <option value="{{ $id }}" {{ (in_array($id, old('permission', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('permission'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('permission') }}
                                            </em>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm"><i class="material-icons">save</i> Save</button>
                            <a href="{{ route('role.index') }}" class="btn btn-sm btn-danger"><i class="material-icons">west</i> Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection