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
        <li class="active">Kategori</li>
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
                        <h2 class="box-title">Data Kategori </h2>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="/admin/kategori/create" class="btn btn-primary"><i class="ion ion-person-add"></i> &nbsp;Add new</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kategori</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $kat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kat->kategori }}</td>
                                <td class="text-center">
                                    <a href="/admin/kategori/{{ $kat->slug }}/edit" title="Update" class="btn btn-sm btn-warning">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>
                                    <form action="/admin/kategori/{{ $kat->slug }}" method="POST" class="d-inline">
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
