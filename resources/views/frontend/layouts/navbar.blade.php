
<div class="header-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-2">
                <div id="mega-menu">
                    <div class="btn-mega"><span></span>ALL CATEGORIES</div>
                    <ul class="menu">
                        @foreach ($config['menu']['menuSide'] as $menu)
                            <li>
                                <a href="/?category={{ $menu->slug }}" title="">
                                    <span class="menu-img">
                                        <img src="/frontend/images/icons/menu/04.png" alt="">
                                    </span>
                                    <span class="menu-title">
                                        {{ $menu->kategori }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div><!-- /.col-md-3 col-2 -->
            <div class="col-md-9 col-10">
                <div class="nav-wrap">
                    <div id="mainnav" class="mainnav">
                        <ul class="menu">
                            <li class="column-1">
                                <a href="/" title="">Home</a>
                            </li>
                            @foreach ($config['menu']['menuCenter'] as $menu)
                            <li class="column-1">
                                <a href="/?category={{ $menu->slug }}" title="">{{ $menu->kategori }}</a>
                            </li>
                            @endforeach
                        </ul><!-- /.menu -->
                    </div><!-- /.mainnav -->
                </div><!-- /.nav-wrap -->
                <div class="btn-menu">
                    <span></span>
                </div><!-- //mobile menu button -->
            </div><!-- /.col-md-9 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.header-bottom -->