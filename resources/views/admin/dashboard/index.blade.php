@extends('admin.layouts.main')

@section('container')
<!-- DataTables -->
<link rel="stylesheet" href="/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- DataTables -->
<script src="/admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    {{ $config['title'] }}
    <small>Welcome {{ auth()->user()->nama_lengkap }}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  {{-- Widget Added --}}
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-th-list"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Produk</span>
          <span class="info-box-number">{{ $produk }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total User</span>
          <span class="info-box-number">{{ $users }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Order Sukses</span>
          <span class="info-box-number">{{ $transSuccess->count() }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Order Butuh Konfirmasi</span>
          <span class="info-box-number">{{ $transaksi->count() }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  {{-- End of Widget --}}
  <!-- /.row -->

  <div class="row">
    {{-- Start Table XXX --}}
    <div class="col-lg-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Order Butuh Konfirmasi</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No.</th>
              <th>Kode Transaksi</th>
              <th>Pembeli</th>
              <th>Produk</th>
              <th>Qty</th>
              <th>Alamat</th>
              <th>Tanggal Transaksi</th>
              <th>#</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($transaksi->get() as $trans)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $trans->kode_transaksi }}</td>
                  <td>{{ $trans->user->nama_lengkap }}</td>
                  <td>{{ $trans->detail_transaksi->first()->produk->nama_produk }} <br> Kategori : {{ $trans->detail_transaksi->first()->produk->kategori->kategori }}</td>
                  <td>{{ $trans->total_qty }} {{ $trans->detail_transaksi->first()->produk->satuan }}</td>
                  <td> {{ $trans->alamat }}</td>
                  <td>{{ date('d F Y H:i:s', strtotime($trans->tanggal_transaksi)) }}</td>
                  <td>
                    <a href="/admin/order/{{ $trans->kode_transaksi }}" title="View Detail" class="btn btn-sm btn-primary">
                      <i class="fa fa-eye"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      {{-- End of Table XXXX --}}
    </div>
  </div>
  
</section>
<!-- /.content -->
<script>
  $(function () {
    $('#example1').DataTable()
  });
</script>
@endsection
