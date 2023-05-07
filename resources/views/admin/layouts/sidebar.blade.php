<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/admin/dist/img/user.jpg" class="img-circle" alt="{{ auth()->user()->nama_lengkap }}">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->nama_lengkap }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">{{ Str::upper(auth()->user()->roles->roles) }} NAVIGATION</li>
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="/admin/dashboard">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
                <a href="/admin/users">
                    <i class="fa fa-users"></i> <span>Users</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="{{ Request::is('admin/produk*') ? 'active' : '' }}">
                <a href="/admin/produk">
                    <i class="fa fa-th-list"></i> <span>Produk</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="{{ Request::is('admin/kategori*') ? 'active' : '' }}">
                <a href="/admin/kategori">
                    <i class="fa fa-file-text"></i> <span>Kategori</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="{{ Request::is('admin/order*') ? 'active' : '' }}">
                <a href="/admin/order">
                    <i class="fa fa-cart-arrow-down"></i> <span>Orderan</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="{{ Request::is('admin/report*') ? 'active' : '' }}">
                <a href="/admin/report">
                    <i class="fa fa-book"></i> <span>Reporting</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            {{-- <li class="header">SETTING</li>
            <li class="{{ Request::is('admin/config*') ? 'active' : '' }}">
                <a href="/admin/config">
                    <i class="fa fa-cog"></i> <span>Config Apps</span>
                </a>
            </li> --}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
