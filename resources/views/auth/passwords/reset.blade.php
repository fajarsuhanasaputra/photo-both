<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <head>
        @include('backend.template.header')
    </head>

    <body class="off-canvas-sidebar">
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="wrapper wrapper-full-page">
            <div class="page-header login-page header-filter" filter-color="black" style="background-image: url({{ (asset('public/assets/img/login.jpg')) }}); background-size: cover; background-position: top center;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                            @include('backend.template.flash', ['$errors' => $errors])
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="card card-login card-hidden">
                                    <div class="card-header card-header-rose text-center">
                                        <h4 class="card-title">{{ __('Reset Password') }}</h4>
                                    </div>
                                    <div class="card-body ">
                                        <span class="bmd-form-group">
                                            <div class="input-group" for="email">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">email</i>
                                                    </span>
                                                </div>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </span>

                                        <span class="bmd-form-group">
                                            <div class="input-group" for="password">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">lock_outline</i>
                                                    </span>
                                                </div>
                                                <input id="password" type="password" placeholder="New Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">


                                            </div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </span>

                                        <span class="bmd-form-group">
                                            <div class="input-group" for="password-confirm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">lock_outline</i>
                                                    </span>
                                                </div>
                                                <input id="password-confirm" type="password" placeholder="Corfirm New Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </span>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-success">
                                                <i class="material-icons">lock_reset</i> {{ __('Reset Password') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('backend.template.script')
        <script>
            $(document).ready(function () {
                md.checkFullPageBackgroundImage();
                setTimeout(function () {
                    $('.card').removeClass('card-hidden');
                }, 700);
            });
        </script>
    </body>
</html>