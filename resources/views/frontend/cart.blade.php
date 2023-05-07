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
                        <a href="#" title="">Cart List</a>
                    </li>
                </ul><!-- /.breacrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.flat-breadcrumb -->


<section class="flat-shop-cart">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="flat-row-title style1">
                    <h3>Shopping Cart</h3>
                </div>
                <div class="table-cart">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="3">Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $item)

                            <tr>
                                <td>
                                    <div class="img-product">
                                        <img src="{{ asset('storage/' . $item->attributes['image']) }}" alt="" />
                                    </div>
                                </td>
                                <td>
                                    <div class="name-product">
                                        {{$item->name}}
                                    </div>
                                </td>
                                <td>
                                    <div class="price">Rp{{ number_format($item->price, 0, ',','.') }}</div>
                                    <div class="clearfix"></div>
                                </td>
                                <td>
                                    <div class="quanlity">
                                        <span class="btn-down"></span>
                                        <input
                                        type="number"
                                        name="number"
                                        value="{{ $item->quantity }}"
                                        min="1"
                                        {{-- max="100" --}}
                                        placeholder="Quanlity"
                                        />
                                        <span class="btn-up"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="total">Rp{{ number_format($item->getPriceSum(), 0, ',','.') }}</div>
                                </td>
                                <td>
                                    <a href="#" title="">
                                        <img src="images/icons/delete.png" alt="" />
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- /.form-coupon -->
                </div>
                <!-- /.table-cart -->
            </div>
            <!-- /.col-lg-8 -->
            <div class="col-lg-4">
                <div class="cart-totals">
                    <h3>Cart Totals</h3>
                    <form action="#" method="get" accept-charset="utf-8">
                        @php
                        $sub = \Cart::session(auth()->user()->id)->getSubTotal();
                        $total = \Cart::session(auth()->user()->id)->getTotal();
                        @endphp
                        <table>
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td class="subtotal">Rp{{ number_format($sub,0,',','.') }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td class="price-total">Rp{{ number_format($total,0,',','.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="btn-cart-totals">
                            <a href="#" class="update" title="">Update Cart</a>
                            <a href="#" class="checkout" title=""
                            >Proceed to Checkout</a
                            >
                        </div>
                        <!-- /.btn-cart-totals -->
                    </form>
                    <!-- /form -->
                </div>
                <!-- /.cart-totals -->
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /.flat-shop-cart -->

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
