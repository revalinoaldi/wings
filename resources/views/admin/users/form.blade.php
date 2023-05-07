@extends('admin.layouts.main')

@section('container')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $config['title'] }}
        <small>Welcome {{ auth()->user()->nama_lengkap }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/users"> Users</a></li>
        <li class="active">Form Users</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    @if (session('notif'))
        {!! session('notif') !!}
    @endif
    <div class="row">
        {{-- Start Table XXX --}}
        <div class="col-lg-8">
            <div class="box">
                
                <div class="box-header with-border row">
                    <div class="col-lg-6">
                        <h2 class="box-title">Data Users Active</h2>
                    </div>
                    <div class="col-lg-6 text-right">
                    </div>
                </div>
                <!-- /.box-header -->
                <form class="form-horizontal" action="/admin/users{{ @$user->username ? "/".$user->username : '' }}" method="POST">
                    @if (@$user->username)
                    @method('put')
                    @endif
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nama_lengkap" class="col-sm-2 control-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('nama_lengkap', @$user->nama_lengkap) }}" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" placeholder="Masukan Nama" required>
                                @error('nama_lengkap')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('username', @$user->username) }}" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Masukan Username" required>
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" value="{{ old('email', @$user->email) }}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukan Email" required>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            
                            <div class="col-sm-10">
                                <input type="password" class="form-control @error('alamat') is-invalid @enderror" id="password" name="password" placeholder="Masukan Password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="no_telp" class="col-sm-2 control-label">No Telp.</label>
                            <div class="col-sm-10">
                                <input type="number" value="{{ old('no_telp', @$user->no_telp) }}" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" placeholder="Masukan No Telp">
                                @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Masukan Alamat">{{ old('alamat', @$user->alamat) }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="roles_id" class="col-sm-2 control-label">Roles</label>
                            <div class="col-sm-10">
                                <select name="roles_id" id="roles_id" class="form-control @error('roles_id') is-invalid @enderror">
                                    @foreach ($roles as $role)
                                    <option {{ old('roles_id', @$user->roles_id) == $role->id ? 'selected=""' : '' }} value="{{ $role->id }}">
                                        {{ $role->roles }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('roles_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="button" onclick="window.history.back(-1)" class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-info pull-right">Save Record</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
                <!-- /.box-body -->
            </div>
            {{-- End of Table XXXX --}}
        </div>
    </div>
    
</section>
<!-- /.content -->

@endsection
