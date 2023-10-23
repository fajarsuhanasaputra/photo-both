<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <head>
        @include('backend.template.header')
    </head>

    <body>
        <div class="wrapper ">
            @include('backend.template.sidebar')

            <div class="main-panel">
                <!-- Navbar -->
                @include('backend.template.navbar')
                <!-- End Navbar -->
                @yield('content')
                @include('backend.template.footer')
            </div>
        </div>
        @include('backend.template.script')
        @include('sweetalert::alert',['cdn'=>"https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    </body>
</html>
