<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <ul class="flat-support">
                    <li class="phone">
                        <span class="text-warning">Call Us</span>: <a href="#" title="">(888) 1234 56789</a>
                    </li>
                </ul><!-- /.flat-support -->
            </div><!-- /.col-md-4 -->
            <div class="col-md-4">
                &nbsp;
            </div><!-- /.col-md-4 -->
            <div class="col-md-4">
                <ul class="flat-unstyled">
                    <li class="account">
                        <a href="#" title="">
                            {{ isset(auth()->user()->id) ? auth()->user()->nama_lengkap : 'My Account' }}
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </a>
                        <ul class="unstyled">
                            @cannot('access', (@auth()->user()->id ?? ''))
                            <li>
                                <a href="/login" title="" >Login</a>
                            </li>
                            <li>
                                <a href="/register" title="" >Register</a>
                            </li>
                            @endcannot

                            @can('access', (@auth()->user()->id ?? ''))
                            <li>
                                <a href="/my-order" title="">My Order</a>
                            </li>
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button class="logout">Logout</button>
                                </form>
                            </li>

                            @endcan
                        </ul>
                    </li>
                </ul><!-- /.flat-unstyled -->
            </div><!-- /.col-md-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.header-top -->
<div class="header-middle">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div id="logo" class="logo">
                    <a href="index.html" title="">
                        <img src="/frontend/images/logos/logo.png" alt="">
                    </a>
                </div><!-- /#logo -->
            </div><!-- /.col-md-3 -->
            <div class="col-md-6">
                <div class="top-search">
                    <form action="#" method="GET" class="form-search" accept-charset="utf-8">
                        <div class="cat-wrap">
                            <select name="category">
                                <option hidden value="">All Category</option>
                                @foreach ($config['menu']['menuSide'] as $menu)
                                    <option hidden value="{{ $menu->slug }}">{{ $menu->kategori }}</option>
                                @endforeach
                            </select>
                            <span><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                            <div class="all-categories">
                                <div class="cat-list-search">
                                    <div class="title">
                                        All Category
                                    </div>
                                    <ul>
                                        @foreach ($config['menu']['menuSide'] as $menu)
                                            <li>
                                                {{ $menu->kategori }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div><!-- /.cat-list-search -->
                            </div><!-- /.all-categories -->
                            <span><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                        </div><!-- /.cat-wrap -->
                        <div class="box-search">
                            <input type="text" name="search" placeholder="Search what you looking for ?">
                            <span class="btn-search">
                                <button type="submit"><img src="/frontend/images/icons/search.png" alt=""></button>
                            </span>
                        </div><!-- /.box-search -->
                    </form><!-- /.form-search -->
                </div><!-- /.top-search -->
            </div><!-- /.col-md-6 -->
            {{-- <div class="col-md-3">
                <div class="box-cart">
                    <div class="inner-box">
                        <a href="/cart-list" title="">
                            <div class="icon-cart">
                                <img src="/frontend/images/icons/cart.png" alt="">
                                <span>{{ \Cart::getTotalQuantity() }}</span>
                            </div>
                            @php
                                $sub = \Cart::getSubTotal();
                            @endphp
                            <div class="price">
                                Rp{{ number_format($sub,0,',','.') }}
                            </div>
                        </a>
                    </div><!-- /.inner-box -->
                </div><!-- /.box-cart -->
            </div> --}}
            <!-- /.col-md-3 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.header-middle -->
