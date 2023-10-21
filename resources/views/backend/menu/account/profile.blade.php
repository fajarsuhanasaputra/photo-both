@extends('backend.template.master')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('backend.template.flash', ['$errors' => $errors])
                <div class="card">
                    <div class="card-header card-header-tabs card-header-rose">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#profile" data-toggle="tab">
                                            <i class="material-icons">badge</i> Profile
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="profile">
                                <form method="post" action="{{ url('my-profile/update/'.Auth::user()->id) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}
                                    <div class="row">
                                        <div class="col-md-9">
                                            <label>Name </label>
                                            <input class="form-control" name="name" type="text" value="{{ Auth::user()->name }}">

                                            <label>Email</label>
                                            <input class="form-control" name="email" type="email" value="{{ Auth::user()->email }}">

                                            <label>User Level</label> <br>
                                            @foreach(Auth::user()->roles()->pluck('name') as $role)
                                            <span class="badge badge-info">{{ $role }}</span>
                                            @endforeach
                                        </div>
                                        <hr>
                                        <div class="col-6">
                                            <a href="{{ route('change-password') }}" class="btn btn-sm btn-warning">
                                                <i class="material-icons">lock</i> Password
                                            </a>
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="material-icons">save</i> Simpan
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="position: relative;top: -40px;right: 0px;margin-bottom: -40px;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="material-icons">logout</i> Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@stop