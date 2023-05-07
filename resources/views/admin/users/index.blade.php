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
        <li class="active">Users</li>
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
                        <h2 class="box-title">Data Users Active </h2>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="/admin/users/create" class="btn btn-primary"><i class="ion ion-person-add"></i> &nbsp;Add new</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Users</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>No Telp.</th>
                                <th>Alamat</th>
                                <th>Roles</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->nama_lengkap }}</td>
                                <td>{{ $user->username }}</td>
                                <td> {{ $user->email }}</td>
                                <td> {{ $user->no_telp }}</td>
                                <td> {{ $user->alamat }}</td>
                                <td> {{ $user->roles->roles }}</td>
                                <td class="text-center">
                                    @cannot('access', $user->id)
                                    {{-- <a href="/dashboard/posts/{{ $user->username }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a> --}}
                                    <a href="/admin/users/{{ $user->username }}/edit" title="Update" class="btn btn-sm btn-warning">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>
                                    
                                    <form action="/admin/users/{{ $user->username }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger border-0">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    @endcannot
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
