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
    <li class="active">Order</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  @if (session('notif'))
  {!! session('notif') !!}
  @endif
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
                <th>Qty</th>
                <th>Alamat</th>
                <th>Tanggal Transaksi</th>
                <th>Status</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transaksi as $trans)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $trans->kode_transaksi }}</td>
                <td>{{ $trans->user->nama_lengkap }}</td>
                <td>{{ $trans->total_qty }} </td>
                <td>{{ $trans->alamat }}</td>
                <td>{{ date('d F Y H:i:s', strtotime($trans->tanggal_transaksi)) }}</td>
                <td>
                  @if ($trans->status_transaksi == 2)
                      <span class="btn btn-danger">Cancel</span>
                  @elseif ($trans->status_transaksi == 1)
                    <span class="btn btn-success">Confirm</span>
                  @else
                    <span class="btn btn-danger">Waiting</span>
                  @endif
                </td>
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
