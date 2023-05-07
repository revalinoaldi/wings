@extends('frontend.layouts.main')

@section('content')

<section class="flat-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumbs">
                    <li class="trail-item">
                        <a href="/" title="">Home</a>
                        <span><img src="/frontend/images/icons/arrow-right.png" alt=""></span>
                    </li>
                    <li class="trail-end">
                        <a href="#" title="">My Order</a>
                    </li>
                </ul><!-- /.breacrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.flat-breadcrumb -->

<section class="flat-wishlist">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wishlist">
                    <div class="title">
                        <h3>My Order Checkout</h3>
                    </div>
                    <div class="wishlist-content">
                        <table class="table-wishlist">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Total Harga</th>
                                    <th>Status Pembayaran</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)

                                <tr>
                                    <td>
                                        <div class="product">
                                            <div class="image">
                                                <img src="{{ asset('storage/' . $order->gambar) }}" alt="{{ $order->nama_produk }}">
                                            </div>
                                            <div class="name">
                                                Kode : {{ $order->kode_transaksi }} <br>
                                                {{ $order->nama_produk }} <br>
                                                <span class="text-muted" style="color: dimgray">Kategori : {{ $order->kategori }}</span> |
                                                <span class="text-muted" style="color: dimgray">Qty : {{ $order->qty.' '.$order->satuan }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="price">
                                            Rp. {{ number_format($order->total_transaksi, 0, ',','.') }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="status-product">
                                            @if ($order->status_transaksi == 0)
                                                <span class="bg-danger">Waiting</span>
                                            @elseif($order->status_transaksi == 1)
                                                <span class="bg-success">Confirmed</span>
                                            @else
                                                <span class="bg-danger">Cancel</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="add-cart">
                                            @if ($order->status_transaksi == 0)
                                                @if ($order->bukti_pembayaran)
                                                    <a href="/paid-order/{{ $order->kode_transaksi }}" title="">
                                                        <img src="/frontend/images/icons/add-cart.png" alt="">Sudah Di Bayar
                                                    </a>
                                                @else
                                                    <a href="/paid-order/{{ $order->kode_transaksi }}" title="">
                                                        <img src="/frontend/images/icons/add-cart.png" alt="">Bayar Sekarang
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table><!-- /.table-wishlist -->
                        <div class="d-flex justify-content-center">
                            {{ $orders->links() }}
                        </div>
                    </div><!-- /.wishlist-content -->
                </div><!-- /.wishlist -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.flat-wishlish -->

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
@endsection
