@extends('admin.layouts.main')

@section('container')
<section class="content-header">
    <h1>
        Invoice
        <small>#{{ $order->kode_transaksi }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/order">Order</a></li>
        <li class="active">Invoice</li>
    </ol>
</section>

<!-- Main content -->
<section class="invoice">
    @if (session('notif'))
    {!! session('notif') !!}
    @endif
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> AdminLTE, Inc.
                <small class="pull-right">Date: {{ date('d/M/Y') }}</small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
                <strong>Admin, Inc.</strong><br>
                795 Folsom Ave, Suite 600<br>
                San Francisco, CA 94107<br>
                Phone: (804) 123-5432<br>
                Email: info@almasaeedstudio.com
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            To
            <address>
                <strong>{{ $order->user->nama_lengkap }}</strong><br>
                {{ $order->alamat }}
                Phone: {{ $order->no_telp }}<br>
                Email: {{ $order->user->email }}
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Invoice #{{ $order->kode_transaksi }}</b><br>
            <br>
            <b>Payment Due:</b> {{ date('d/M/Y H:i:s', strtotime($order->transaksi_pembayaran->tanggal_pembayaran)) }}<br>
            <b>Account:</b> {{ $order->transaksi_pembayaran->rekening_pembayaran }}
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    
    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Qty</th>
                        <th>Product</th>
                        <th>Kategori</th>
                        <th>Subtotal</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $subtotal = 0; ?>
                    @foreach ($order->detail_transaksi as $detail)
                        
                    <tr>
                        <td>{{ $detail->qty.' '.$detail->satuan }}</td>
                        <td>{{ $detail->produk->nama_produk }}</td>
                        <td>{{ $detail->produk->kategori->kategori }}</td>
                        <td>Rp. {{ number_format($detail->subtotal, 0, ',','.') }}</td>
                        <td>Rp. {{ number_format($detail->total, 0, ',','.') }}</td>
                    </tr>
                    <?php $subtotal += $detail->subtotal; ?>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    
    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6 mb-3">
            <p class="lead">Bukti Bayar:</p>
            <a href="{{ asset('storage/' . $order->transaksi_pembayaran->bukti_pembayaran) }}" target="_blank">
                <img src="{{ asset('storage/' . $order->transaksi_pembayaran->bukti_pembayaran) }}" alt="Visa" class="img-thumbnail img-responsive col-sm-7">
            </a>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
            {{-- <p class="lead">Amount Due 2/22/2014</p> --}}
            
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>Rp. {{ number_format($subtotal, 0, ',','.') }}</td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td>Rp. {{ number_format($order->total_transaksi, 0, ',','.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    
    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            {{-- <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> --}}
            <form action="/admin/order/{{ $order->kode_transaksi }}" method="POST">
                @method('put')
                @csrf
                <input type="hidden" value="2" name="status_transaksi">
                <button onclick="return confirm('Yakin cancel proses order?')" class="btn btn-danger pull-right"> Cancel Order</button>
            </form>
            
            <form action="/admin/order/{{ $order->kode_transaksi }}" method="POST">
                @method('put')
                @csrf
                <input type="hidden" value="1" name="status_transaksi">
                <button onclick="return confirm('Yakin confirm proses order?')" class="btn btn-success pull-right" style="margin-right: 5px;">
                    <i class="fa fa-credit-card"></i> Confirm Order
                </button>
            </form>
            
            
        </div>
    </div>
</section>
<!-- /.content -->
<div class="clearfix"></div>
@endsection