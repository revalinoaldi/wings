@extends('frontend.layouts.main')

@section('content')
{{-- Start Of Content --}}
<section class="flat-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumbs">
                    <li class="trail-item">
                        <a href="#" title="">Home</a>
                        <span><img src="/frontend/images/icons/arrow-right.png" alt=""></span>
                    </li>
                    <li class="trail-end">
                        <a href="#" title="">Home Pages</a>
                    </li>
                </ul><!-- /.breacrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.flat-breadcrumb -->

<section class="flat-slider style2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="slider owl-carousel style2">
                    <div class="slider-item style3">
                        <div class="item-text">
                            <div class="header-item">
                                <p>You can build the banner for other category</p>
                                <h2 class="name"><span>SHOP BANNER</span></h2>
                            </div>
                        </div>
                        <div class="item-image">
                            <img src="/frontend/images/banner_boxes/07.png" alt="">
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.slider-item style3 -->
                    <div class="slider-item style3">
                        <div class="item-text">
                            <div class="header-item">
                                <p>You can build the banner for other category</p>
                                <h2 class="name"><span>SHOP BANNER</span></h2>
                            </div>
                        </div>
                        <div class="item-image">
                            <img src="/frontend/images/banner_boxes/07.png" alt="">
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.slider-item style3 -->
                </div><!-- /.slider -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.flat-slider style2 -->

<main id="shop" class="style2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-shop">
                    <div class="wrap-imagebox">
                        <div class="flat-row-title style4">
                            <h3>All Product</h3>

                            <div class="clearfix"></div>
                        </div><!-- /.flat-row-title style4 -->
                        <div class="row">
                            @foreach ($produks as $produk)

                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="product-box style1">
                                    <div class="imagebox style1">
                                        <div class="box-image">
                                            <a href="/produk/{{ $produk->kode_produk }}" title="">
                                                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="">
                                            </a>
                                        </div><!-- /.box-image -->
                                        <div class="box-content">
                                            <div class="cat-name">
                                                <a href="/produk/{{ $produk->kode_produk }}" title="">{{ $produk->kategori->kategori }}</a>
                                            </div>
                                            <div class="product-name">
                                                <a href="/produk/{{ $produk->kode_produk }}" title="">{{ $produk->nama_produk }}</a>
                                            </div>
                                            @php
                                                $price = (@$produk->discount != 0) ? $produk->harga - (($produk->harga*$produk->discount)/100) : $produk->harga
                                            @endphp
                                            <div class="price">
                                                <span class="regular">Rp.{{ number_format($produk->harga, 0, ',','.') }}</span>
                                                <span class="sale">Rp.{{ number_format($price, 0, ',','.') }}</span>
                                            </div>
                                        </div><!-- /.box-content -->
                                        <div class="box-bottom">

                                            <div class="btn-add-cart">
                                                <a href="/produk/{{ $produk->kode_produk }}" title="">
                                                    <img src="/frontend/images/icons/add-cart.png" alt="">Add to Cart
                                                </a>
                                            </div>
                                        </div><!-- /.box-bottom -->
                                    </div><!-- /.imagebox style1 -->
                                </div>
                            </div>
                            @endforeach
                        </div><!-- /.row -->
                        <div class="d-flex justify-content-center">
                            {{ $produks->links() }}
                        </div>
                    </div><!-- /.main-shop -->
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </main><!-- /#shop -->
    {{-- End Of Content --}}


<section class="flat-row flat-iconbox style2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="iconbox style1">
                    <div class="box-header">
                        <div class="image">
                            <img src="/frontend/images/icons/car.png" alt="">
                        </div>
                        <div class="box-title">
                            <h3>Worldwide Shipping</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.box-header -->
                </div><!-- /.iconbox -->
            </div><!-- /.col-md-6 col-lg-3 -->
            <div class="col-md-6 col-lg-3">
                <div class="iconbox style1">
                    <div class="box-header">
                        <div class="image">
                            <img src="/frontend/images/icons/order.png" alt="">
                        </div>
                        <div class="box-title">
                            <h3>Order Online Service</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.box-header -->
                </div><!-- /.iconbox -->
            </div><!-- /.col-md-6 col-lg-3 -->
            <div class="col-md-6 col-lg-3">
                <div class="iconbox style1">
                    <div class="box-header">
                        <div class="image">
                            <img src="/frontend/images/icons/payment.png" alt="">
                        </div>
                        <div class="box-title">
                            <h3>Payment</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.box-header -->
                </div><!-- /.iconbox -->
            </div><!-- /.col-md-6 col-lg-3 -->
            <div class="col-md-6 col-lg-3">
                <div class="iconbox style1">
                    <div class="box-header">
                        <div class="image">
                            <img src="/frontend/images/icons/return.png" alt="">
                        </div>
                        <div class="box-title">
                            <h3>Return 30 Days</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.box-header -->
                </div><!-- /.iconbox -->
            </div><!-- /.col-md-6 col-lg-3 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.flat-iconbox -->
    {{-- <section class="flat-iconbox">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="iconbox">
                        <div class="box-header">
                            <div class="image">
                                <img src="/frontend/images/icons/car.png" alt="">
                            </div>
                            <div class="box-title">
                                <h3>Worldwide Shipping</h3>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-content">
                            <p>Free Shipping On Order Over $100</p>
                        </div><!-- /.box-content -->
                    </div><!-- /.iconbox -->
                </div><!-- /.col-md-3 col-sm-6 -->
                <div class="col-md-3 col-sm-6">
                    <div class="iconbox">
                        <div class="box-header">
                            <div class="image">
                                <img src="/frontend/images/icons/order.png" alt="">
                            </div>
                            <div class="box-title">
                                <h3>Order Online Service</h3>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-content">
                            <p>Free return products in 30 days</p>
                        </div><!-- /.box-content -->
                    </div><!-- /.iconbox -->
                </div><!-- /.col-md-3 col-sm-6 -->
                <div class="col-md-3 col-sm-6">
                    <div class="iconbox">
                        <div class="box-header">
                            <div class="image">
                                <img src="/frontend/images/icons/payment.png" alt="">
                            </div>
                            <div class="box-title">
                                <h3>Payment</h3>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-content">
                            <p>Secure System</p>
                        </div><!-- /.box-content -->
                    </div><!-- /.iconbox -->
                </div><!-- /.col-md-3 col-sm-6 -->
                <div class="col-md-3 col-sm-6">
                    <div class="iconbox">
                        <div class="box-header">
                            <div class="image">
                                <img src="/frontend/images/icons/return.png" alt="">
                            </div>
                            <div class="box-title">
                                <h3>Return 30 Days</h3>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-content">
                            <p>Free return products in 30 days</p>
                        </div><!-- /.box-content -->
                    </div><!-- /.iconbox -->
                </div><!-- /.col-md-3 col-sm-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.flat-iconbox --> --}}
    @endsection
