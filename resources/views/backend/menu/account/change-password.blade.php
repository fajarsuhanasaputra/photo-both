@extends('backend.template.master')

@section('sub-title')
- Profile
@stop

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                @include('backend.template.flash', ['$errors' => $errors])
                <div class="card">

                    <div class="card-header card-header-tabs card-header-rose">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#change-password" data-toggle="tab">
                                            <i class="material-icons">lock_person</i> Change Password
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="change-password">
                                <form method="post" action="{{ url('/update-password/') }}">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label> Old Password</label>
                                            <input class="form-control" name="old_password" type="password" placeholder="Old Password">
                                        </div>

                                        <div class="col-md-4">
                                            <label> New Password</label>
                                            <input class="form-control" name="new_password" type="password" placeholder="New Password">
                                        </div>

                                        <div class="col-md-4">
                                            <label> Confirm New Password</label>
                                            <input class="form-control" name="confirm_password" type="password" placeholder="Confirm New Password">
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="material-icons">published_with_changes</i> Ubah Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</section>
@stop