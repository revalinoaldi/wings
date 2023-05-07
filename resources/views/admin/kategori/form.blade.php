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
        <li><a href="/admin/kategori"> Kategori</a></li>
        <li class="active">Form Kategori</li>
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
                        <h2 class="box-title">Data Kategori Active</h2>
                    </div>
                    <div class="col-lg-6 text-right">
                    </div>
                </div>
                <!-- /.box-header -->
                <form class="form-horizontal" action="/admin/kategori{{ @$kategori->slug ? "/".$kategori->slug : '' }}" method="POST">
                    @if (@$kategori->slug)
                    @method('put')
                    @endif
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="kategori" class="col-sm-2 control-label">Nama Kategori</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('kategori', @$kategori->kategori) }}" class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori" placeholder="Masukan Nama Kategori" required>
                                @error('kategori')
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
