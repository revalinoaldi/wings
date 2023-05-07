<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="widget-ft widget-about">
                    <div class="logo logo-ft">
                        <a href="index.html" title="">
                            <img src="/frontend/images/logos/logo-ft.png" alt="">
                        </a>
                    </div><!-- /.logo-ft -->
                    <div class="widget-content">
                        <div class="icon">
                            <img src="/frontend/images/icons/call.png" alt="">
                        </div>
                        <div class="info">
                            <p class="questions">Got Questions ? Call us 24/7!</p>
                            <p class="phone">Call Us: (888) 1234 56789</p>
                            <p class="address">
                                PO Box CT16122 Collins Street West, Victoria 8007,<br />Australia.
                            </p>
                        </div>
                    </div><!-- /.widget-content -->
                    
                </div><!-- /.widget-about -->
            </div><!-- /.col-lg-3 col-md-6 -->
            <div class="col-lg-3 col-md-6">
                <div class="widget-ft widget-categories-ft">
                    <div class="widget-title">
                        <h3>Find By Categories</h3>
                    </div>
                    <ul class="cat-list-ft">
                        @foreach ($config['menu']['menuSide'] as $menu)
                            <li>
                                <a href="#" title="">{{ $menu->kategori }}</a>
                            </li>
                        @endforeach
                    </ul><!-- /.cat-list-ft -->
                </div><!-- /.widget-categories-ft -->
            </div><!-- /.col-lg-3 col-md-6 -->
            <div class="col-lg-2 col-md-6">
                &nbsp;
            </div><!-- /.col-lg-2 col-md-6 -->
            <div class="col-lg-4 col-md-6">
                <div class="widget-ft widget-newsletter">
                    <div class="widget-title">
                        <h3>Sign Up To New Letter</h3>
                    </div>
                    <p>Make sure that you never miss our interesting 
                        news by joining our newsletter program
                    </p>
                    <form action="#" class="subscribe-form" method="get" accept-charset="utf-8">
                        <div class="subscribe-content">
                            <input type="text" name="email" class="subscribe-email">
                            <button type="submit"><img src="/frontend/images/icons/right-2.png" alt=""></button>
                        </div>
                    </form><!-- /.subscribe-form -->
                </div><!-- /.widget-newsletter -->
            </div><!-- /.col-lg-4 col-md-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</footer><!-- /footer -->

<section class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="copyright"> All Rights Reserved © Techno Store {{ date('Y') }}</p>
                <p class="btn-scroll">
                    <a href="#" title="">
                        <img src="/frontend/images/icons/top.png" alt="">
                    </a>
                </p>
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.footer-bottom -->