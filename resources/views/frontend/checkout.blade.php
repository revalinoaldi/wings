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
                    <li class="trail-item">
                        <a href="/" title="">Produk</a>
                        <span><img src="/frontend/images/icons/arrow-right.png" alt=""></span>
                    </li>
                    <li class="trail-end">
                        <a href="#" title="">Checkout</a>
                    </li>
                </ul><!-- /.breacrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.flat-breadcrumb -->

<section class="flat-checkout">
    <div class="container">
        <form action="/ordered" method="POST">
            @csrf
        <div class="row">
                <div class="col-md-6">
                    <div class="box-checkout">
                        <h3 class="title">Checkout</h3>

                        @php
                            $price = (@$produk->discount != 0) ? $produk->harga - (($produk->harga*$produk->discount)/100) : $produk->harga
                        @endphp

                        <div class="billing-fields">
                            <div class="fields-content">
                                <div class="field-row">
                                    <label for="nama_lengkap">Nama Lengkap *</label>
                                    <input type="text" id="nama_lengkap" name="nama_lengkap" required value="{{ auth()->user()->nama_lengkap }}" readonly>
                                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                    <input type="hidden" name="qty" value="{{ $qty }}">
                                    <input type="hidden" name="total" value="{{ $qty*$price }}">
                                    <input type="hidden" name="subtotal" value="{{ $price }}">

                                </div>
                                <div class="field-row">
                                    <label for="email">Email *</label>
                                    <input type="email" id="email" name="email" required value="{{ auth()->user()->email }}" readonly style="padding-left: 30px !important;">
                                </div>
                                <div class="field-row">
                                    <label for="no_telp">No Telp. *</label>
                                    <input type="number" id="no_telp" name="no_telp" required value="0{{ auth()->user()->no_telp }}" readonly>
                                </div>

                                <div class="field-row">
                                    <label for="alamat">Alamat *</label>
                                    <textarea id="alamat" name="alamat" required readonly>{{ auth()->user()->alamat }}</textarea>
                                </div>
                                <div class="clearfix"></div>
                            </div><!-- /.fields-content -->
                        </div><!-- /.billing-fields -->
                        <div class="shipping-address-fields">

                            <div class="fields-content">
                                <div class="checkbox">
                                    <input type="checkbox" id="anotherSend" name="anotherSend">
                                    <label for="anotherSend">Kirim ke Alamat Lain ?</label>
                                </div>
                                <div id="anotherAddress" hidden>
                                    <div class="field-row">
                                        <label for="no_telpLain">No Telp. Baru *</label>
                                        <input type="number" id="no_telpLain" name="no_telpLain" placeholder="Masukan No Telp">
                                    </div>
                                    <div class="field-row">
                                        <label for="alamatLain">Alamat Baru *</label>
                                        <textarea id="alamatLain" name="alamatLain" placeholder="Masukan Alamat Lengkap"></textarea>
                                    </div>
                                </div>
                            </div><!-- /.fields-content -->
                        </div><!-- /.shipping-address-fields -->

                    </div><!-- /.box-checkout -->
                </div><!-- /.col-md-7 -->

                <div class="col-md-6">
                    <div class="cart-totals style2">
                        <h3>Your Order</h3>

                        <table class="product">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $produk->nama_produk }} <br>(Qty : {{ $qty }} & Discount : {{$produk->discount}}%)</td>
                                    <td>
                                        <p><strong>Rp.{{ number_format($price, 0, ',','.') }}</strong></p>
                                        @if (@$produk->discount != 0)
                                        <p>
                                            <s>Rp.{{ number_format($produk->harga, 0, ',','.') }}</s>
                                        </p>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table><!-- /.product -->
                        <table>
                            <tbody>
                                <tr>
                                    <td>Sub Total</td>
                                    <td class="subtotal"><strong>Rp. {{ number_format(($price*$qty), 0, ',','.') }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Grand Total</td>
                                    <td class="price-total"><strong>Rp. {{ number_format(($price*$qty), 0, ',','.') }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="checkbox">
                            <input type="checkbox" id="checked-order" name="checked-order" required>
                            <label for="checked-order">I’ve read and accept the terms & conditions *</label>
                        </div><!-- /.checkbox -->
                        <div class="btn-order">
                            <button class="order" id="orderButton" disabled title="">Checkout Sekarang!</button>
                        </div><!-- /.btn-order -->

                    </div><!-- /.cart-totals style2 -->
                </div><!-- /.col-md-5 -->

        </div><!-- /.row -->
    </form><!-- /.checkout -->
    </div><!-- /.container -->
</section><!-- /.flat-checkout -->

<section class="flat-row flat-iconbox style5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
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
            </div><!-- /.col-lg-3 col-md-6 -->
            <div class="col-lg-3 col-md-6">
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
            </div><!-- /.col-lg-3 col-md-6 -->
            <div class="col-lg-3 col-md-6">
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
            </div><!-- /.col-lg-3 col-md-6 -->
            <div class="col-lg-3 col-md-6">
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
            </div><!-- /.col-lg-3 col-md-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.flat-iconbox -->
<script>
    const checking = document.querySelector('#anotherSend');
    const anotherAddress = document.querySelector('#anotherAddress');
    checking.addEventListener('change', (event) => {
        if (checking.checked) {
            anotherAddress.removeAttribute('hidden')
            document.querySelector('#no_telpLain').setAttribute('required','');
            document.querySelector('#alamatLain').setAttribute('required','');
        }else{
            anotherAddress.setAttribute('hidden','')
            document.querySelector('#no_telpLain').removeAttribute('required');
            document.querySelector('#alamatLain').removeAttribute('required');
        }
    })
    const checkorder = document.querySelector('#checked-order');
    checkorder.addEventListener('change', (event) => {
        if (checkorder.checked) {
            document.querySelector('#orderButton').removeAttribute('disabled');
        }else{
            document.querySelector('#orderButton').setAttribute('disabled','');
        }
    })
</script>
@endsection
