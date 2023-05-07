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
                        <a href="/" title="">Checkout</a>
                        <span><img src="/frontend/images/icons/arrow-right.png" alt=""></span>
                    </li>
                    <li class="trail-end">
                        <a href="#" title="">Paid</a>
                    </li>
                </ul><!-- /.breacrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.flat-breadcrumb -->

<section class="flat-checkout">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="box-checkout">
                    <h3 class="title">Checkout</h3>
                    
                    <div class="billing-fields">
                        <div class="fields-content">
                            <div class="field-row">
                                <label for="nama_lengkap">Nama Lengkap *</label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap" required value="{{ $order->user->nama_lengkap }}" readonly>
                            </div>
                            <div class="field-row">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" required value="{{ $order->user->email }}" readonly style="padding-left: 30px !important;">
                            </div>
                            <div class="field-row">
                                <label for="no_telp">No Telp. *</label>
                                <input type="number" id="no_telp" name="no_telp" required value="0{{ $order->no_telp }}" readonly>
                            </div>
                            
                            <div class="field-row">
                                <label for="total">Grand Total *</label>
                                <input type="text" id="total" name="total" required value="{{ number_format($order->total_transaksi, 0, ',', '.') }}" readonly>
                            </div>
                            
                            <div class="field-row">
                                <label for="alamat">Alamat *</label>
                                <textarea id="alamat" name="alamat" required readonly>{{ $order->alamat }}</textarea>
                            </div>
                            <div class="clearfix"></div>
                        </div><!-- /.fields-content -->
                    </div><!-- /.billing-fields -->
                    
                </div><!-- /.box-checkout -->
            </div><!-- /.col-md-7 -->
            
            <div class="col-md-6">
                <form action="/paid-order/{{ $order->kode_transaksi }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="cart-totals style2">
                        <h3>Paid Your Order</h3>    
                        <div class="fields-content">
                            <div class="field-row">
                                <label for="jumlah_pembayaran">Jumlah Bayar *</label>
                                <input type="number" id="jumlah_pembayaran" name="jumlah_pembayaran" required>
                                @if (session('message'))
                                <div class="invalid-feedback text-danger">
                                    {{ session('message') }}
                                </div>
                                @endif
                                @error('jumlah_pembayaran')
                                <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>     
                        
                        <div class="btn-radio style2">
                            @foreach ($rekening as $atm)
                            <div class="radio-info">
                                <input type="radio" id="{{ $atm['rekening'] }}" value="{{ $atm['deskripsi'] }}" name="rekening_pembayaran">
                                <label for="{{ $atm['rekening'] }}">{{ $atm['rekening'] }}</label>
                                <p>{{ $atm['deskripsi'] }}</p>
                            </div>
                            @endforeach
                            @error('rekening_pembayaran')
                            <div class="invalid-feedback text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div><!-- /.btn-radio style2 -->      
                        <div class="fields-content">
                            <div class="field-row">
                                <label for="bukti_pembayaran">Bukti Bayar *</label>
                                <input class="form-control @error('bukti_pembayaran') is-invalid @enderror" type="file" id="bukti_pembayaran" name="bukti_pembayaran" {{ @$order->bukti_pembayaran ? '' : 'required' }} accept="image/*" onchange="loadFile(event,`avatarPreview`)">
                                @error('bukti_pembayaran')
                                <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="mt-3">
                                    <img src="{{ @$order->bukti_pembayaran ? asset('storage/' . $order->bukti_pembayaran) : '' }}" alt="" id="avatarPreview" class="rounded img-fluid col-sm-7"><br>
                                </div>
                            </div>
                        </div>
                        <div class="btn-order">
                            <button class="order" id="orderButton" title="">Bayar Sekarang!</button>
                        </div><!-- /.btn-order -->
                    </div><!-- /.cart-totals style2 -->
                </form>
            </div><!-- /.col-md-5 -->
            
        </div><!-- /.row -->
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
    var loadFile = function(event,target) {
        var avatar = document.getElementById(target);
        avatar.src = URL.createObjectURL(event.target.files[0]);
        avatar.onload = function() {
            URL.revokeObjectURL(avatar.src) // free memory
        }
    };
    
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