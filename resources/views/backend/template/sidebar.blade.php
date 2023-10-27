<div class="sidebar" data-color="rose" data-background-color="black" data-image="{{ (asset('assets/img/sidebar-1.jpg')) }}">
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            BM
        </a>
        <a href="#" class="simple-text logo-normal">
            BUTUHMOMENT
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">

            <div class="user-info">
                <ul class="nav">
                    <li class="nav-item {{ (request()->segment(1) == 'my-profile') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('my-profile') }}">
                            <span class="sidebar-normal"> {{ Auth::user()->name }} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="nav">
            <li class="nav-item {{ (request()->segment(1) == 'home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="material-icons">dashboard</i>
                    <p> Dashboard </p>
                </a>
            </li>

            <li class="nav-item {{ (request()->segment(1) == 'transaction') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('transaction.index')}}">
                    <i class="material-icons">map</i>
                    <p> User Tracking / Transaksi </p>
                </a>
            </li>

            <li class="nav-item {{ (request()->segment(1) == 'list-contact') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('list-contact.index')}}">
                    <i class="material-icons">contact_mail</i>
                    <p> List Form </p>
                </a>
            </li>


            <li class="nav-item {{ (request()->segment(1) == 'booth') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('booth.index') }}">
                    <i class="material-icons">work</i>
                    <p> Booth Management</p>
                </a>
            </li>

            <li class="nav-item {{ (request()->segment(1) == 'user') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.index')}}">
                    <span class="sidebar-mini">
                        <i class="material-icons">manage_accounts</i>
                    </span>
                    <span class="sidebar-normal"> Users Management</span>
                </a>
            </li>

            <li class="nav-item {{ (request()->segment(1) == 'package') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('package.index')}}">
                    <i class="material-icons">percent</i>
                    <p> Paket </p>
                </a>
            </li>


            <li class="nav-item {{ (request()->segment(1) == 'color') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('color.index')}}">
                    <span class="sidebar-mini">
                        <i class="material-icons">format_color_fill</i>
                    </span>
                    <span class="sidebar-normal"> Color Filter </span>
                </a>
            </li>

            <li class="nav-item {{ (request()->segment(1) == 'frame') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('frame.index')}}">
                    <span class="sidebar-mini">
                        <i class="material-icons">wallpaper</i>
                    </span>
                    <span class="sidebar-normal"> Image Frame </span>
                </a>
            </li>


            <li class="nav-item {{ (request()->segment(1) == 'voucher') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('voucher.index')}}">
                    <i class="material-icons">money</i>
                    <p> Data Voucher </p>
                </a>
            </li>

        </ul>
    </div>
</div>
