@extends('frontend.layouts.main')

@section('content')


<section class="flat-account background">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-register" style="height: auto;">
                    <div class="title" style="margin-bottom: 50px;">
                        <h3>Register</h3>
                        <hr>
                    </div>
                    
                    <form action="/register" method="POST" id="form-register">
                        @csrf
                        <div class="form-box">
                            <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span> </label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" required value="{{ old('nama_lengkap') }}" placeholder="Masukan Nama Lengkap">
                            @error('nama_lengkap')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div><!-- /.form-box -->
                        <div class="form-box">
                            <label for="username">username <span class="text-danger">*</span> </label>
                            <input type="text" id="username" name="username" required value="{{ old('username') }}" placeholder="Masukan Username">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div><!-- /.form-box -->
                        <div class="form-box">
                            <label for="email">Email address <span class="text-danger">*</span> </label>
                            <input type="email" id="email" name="email" required value="{{ old('email') }}" placeholder="Masukan Email" style="padding-left: 30px !important;">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div><!-- /.form-box -->
                        <div class="form-box">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" id="password" name="password" required placeholder="Masukan Password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div><!-- /.form-box -->
                        <div class="form-box">
                            <label for="no_telp">No. Telp.</label>
                            <input type="number" id="no_telp" name="no_telp" required value="{{ old('no_telp') }}" placeholder="Masukan No Telp">
                            @error('no_telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div><!-- /.form-box -->
                        <div class="form-box">
                            <label for="alamat">Alamat</label>
                            <input type="text" id="alamat" name="alamat" required value="{{ old('alamat') }}" placeholder="Masukan Alamat">
                            @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div><!-- /.form-box -->
                        <div class="form-box text-right">
                            <button type="submit" class="register">Register</button>
                        </div><!-- /.form-box -->
                        
                    </form><!-- /#form-register -->
                </div><!-- /.form-register -->
            </div><!-- /.col-md-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.flat-account -->

<section class="flat-row flat-iconbox style1 background">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="iconbox style1 v1">
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
                <div class="iconbox style1 v1">
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
                <div class="iconbox style1 v1">
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
                <div class="iconbox style1 v1">
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