<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-minimize">
                <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                    <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                    <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                </button>
            </div>
            <a class="navbar-brand" href="javascript:;">
                {{ (request()->segment(1) == 'home') ? 'Dashboard' : '' }}
                {{ (request()->segment(1) == 'booth') ? 'Booth' : '' }}
                {{ (request()->segment(1) == 'transaction') ? 'User Tracking / Transaksi' : '' }}
                {{ (request()->segment(1) == 'user') ? 'User Management' : '' }}
                {{ (request()->segment(1) == 'list-guest') ? 'List Guests' : '' }}
                {{ (request()->segment(1) == 'list-contact') ? 'List Forms' : '' }}
                {{ (request()->segment(1) == 'my-profile') ? 'My Profile' : '' }}
                {{ (request()->segment(1) == 'change-password') ? 'Change Password' : '' }}
                {{ (request()->segment(1) == 'color') ? 'Color Filter' : '' }}
                {{ (request()->segment(1) == 'frame') ? 'Image Frame' : '' }}
                {{ (request()->segment(1) == 'voucher') ? 'Data Voucher' : '' }}
                {{ (request()->segment(1) == 'package') ? 'Paket' : '' }}
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
    </div>
</nav>