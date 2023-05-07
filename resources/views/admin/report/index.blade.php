@extends('admin.layouts.main')

@section('container')
<link href="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/b-print-2.3.6/datatables.min.css" rel="stylesheet"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/b-print-2.3.6/datatables.min.js"></script>


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
{{-- {{ dd($transaksi->toArray()) }} --}}

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
                <th>Alamat Customer</th>
                <th>Tanggal Transaksi</th>
                <th>Total Transaksi</th>
                <th>Transfer</th>
                <th>Tgl Transfer</th>

                <th>Status</th>
                <th>Item</th>

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
                <td>Rp{{ number_format($trans->total_transaksi, 0, ',','.') }}</td>
                <td>{{ @$trans->transaksi_pembayaran->rekening_pembayaran ?? ' - ' }}</td>
                <td>{{ @$trans->transaksi_pembayaran->tanggal_pembayaran ? \Carbon\Carbon::parse($trans->transaksi_pembayaran->tanggal_pembayaran)->format('d F Y H:i:s') : ' - ' }}</td>
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
                    <ul>
                        @foreach ($trans->detail_transaksi as $item)
                            <li>
                                <p>{{ $item->produk->nama_produk }}</p>
                                <p>(Qty : {{ $item->qty}} {{ $item->satuan }} | Subtotal : Rp{{ number_format($item->subtotal, 0, ',','.') }})</p>
                            </li>
                        @endforeach
                    </ul>
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
    $('#example1').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    })
  });
</script>
@endsection
