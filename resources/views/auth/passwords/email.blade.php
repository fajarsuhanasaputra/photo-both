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
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="card card-login card-hidden">
                                    <div class="card-header card-header-rose text-center">
                                        <h4 class="card-title">{{ __('Email Address') }}</h4>
                                    </div>
                                    <div class="card-body ">
                                        <span class="bmd-form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">email</i>
                                                    </span>
                                                </div>
                                                <input id="email" placeholder="E-mail Address" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </span>
                                    </div>


                                    <div class="card-footer justify-content-center">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="material-icons">outgoing_mail</i> {{ __('Send Password Reset Link') }}
                                        </button>
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