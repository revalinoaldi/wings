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
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Produk</li>
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
                <div class="box-header with-border row">
                    <div class="col-lg-6">
                        <h2 class="box-title">Data Produk</h2>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="/admin/produk/create" class="btn btn-primary"><i class="ion ion-person-add"></i> &nbsp;Add new</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $produk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $produk->kode_produk }}</td>
                                <td>{{ $produk->nama_produk }}</td>
                                <td> {{ $produk->kategori->kategori }}</td>
                                <td> {{ $produk->stok }} {{ $produk->satuan }}</td>
                                @php
                                    $price = (@$produk->discount != 0) ? $produk->harga - (($produk->harga*$produk->discount)/100) : $produk->harga
                                @endphp
                                <td>
                                    <p>Rp.{{ number_format($price, 0, ',','.') }}</p>
                                    @if (@$produk->discount != 0)
                                    <p>
                                        <s>Rp.{{ number_format($produk->harga, 0, ',','.') }}</s>
                                    </p>
                                    @endif

                                </td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="img-thumbnail img-responsive col-sm-7">
                                </td>
                                <td class="text-center">
                                    @if (@$produk->kategori->deleted_at)
                                        <span class="badge badge-danger">Draf</span>
                                    @else
                                        <span class="badge badge-success">Publish</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="/admin/produk/{{ $produk->kode_produk }}/edit" title="Update" class="btn btn-sm btn-warning">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>

                                    <form action="/admin/produk/{{ $produk->kode_produk }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger border-0">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
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
