@extends('admin.layouts.main')

@section('container')
<link rel="stylesheet" href="/admin/plugins/trix/dist/trix.css">
<script src="/admin/plugins/trix/dist/trix.js"></script>

<style>
    trix-toolbar [data-trix-button-group="file-tools"]{
        display: none;
    }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $config['title'] }}
        <small>Welcome {{ auth()->user()->nama_lengkap }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/produk"> Produk</a></li>
        <li class="active">Form Produk</li>
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
                        <h2 class="box-title">Data Form Produk</h2>
                    </div>
                    <div class="col-lg-6 text-right">
                    </div>
                </div>
                <!-- /.box-header -->
                <form class="form-horizontal" action="/admin/produk{{ @$produk->kode_produk ? "/".$produk->kode_produk : '' }}" method="POST" enctype="multipart/form-data">
                    @if (@$produk->kode_produk)
                    @method('put')
                    @endif
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="kode_produk" class="col-sm-2 control-label">Kode Produk</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('kode_produk', @$produk->kode_produk) }}" class="form-control @error('kode_produk') is-invalid @enderror" id="kode_produk" name="kode_produk" placeholder="Masukan Kode Produk" required>
                                <small class="text-muted">Add Kode Produk Max Lenght : 10 Char</small>
                                @error('kode_produk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_produk" class="col-sm-2 control-label">Nama Produk</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('nama_produk', @$produk->nama_produk) }}" class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk" name="nama_produk" placeholder="Masukan Nama Produk" required>
                                @error('nama_produk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ketegori_id" class="col-sm-2 control-label">Kategori</label>
                            <div class="col-sm-10">
                                <select name="ketegori_id" id="ketegori_id" class="form-control @error('ketegori_id') is-invalid @enderror">
                                    @foreach ($kategori as $kat)
                                    <option {{ old('ketegori_id', @$produk->ketegori_id) == $kat->id ? 'selected=""' : '' }} value="{{ $kat->id }}">
                                        {{ $kat->kategori }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('ketegori_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="stok" class="col-sm-2 control-label">Stok</label>
                            <div class="col-sm-10">
                                <input type="number" value="{{ old('stok', @$produk->stok) }}" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" placeholder="Masukan stok" required>
                                @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="satuan" class="col-sm-2 control-label">Satuan Barang</label>
                            <div class="col-sm-10">
                                <select name="satuan" id="satuan" class="form-control @error('satuan') is-invalid @enderror">
                                    <?php $satuan = ['Pcs','Set','Unit','Lot']; ?>
                                    @foreach ($satuan as $key => $val)
                                    <option {{ old('satuan', @$produk->satuan) == $val ? 'selected=""' : '' }} value="{{ $val }}">
                                        {{ $val }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('satuan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="harga" class="col-sm-2 control-label">Harga Produk</label>
                            <div class="col-sm-10">
                                <input type="number" value="{{ old('harga', @$produk->harga) }}" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" placeholder="Masukan Harga Produk">
                                @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="discount" class="col-sm-2 control-label">Diskon Produk</label>
                            <div class="col-sm-10">
                                <input type="number" value="{{ old('discount', @$produk->discount ?? 0) }}" class="form-control @error('harga') is-invalid @enderror" id="discount" name="discount" placeholder="Masukan Diskon Produk" required>
                                <small class="text-muted">Dalam satuan persen (%)</small>
                                @error('discount')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="berat" class="col-sm-2 control-label">Berat Produk</label>
                            <div class="col-sm-10">
                                <input type="number" value="{{ old('berat', @$produk->berat) }}" class="form-control @error('berat') is-invalid @enderror" id="berat" name="berat" placeholder="Masukan Berat Produk">
                                <small class="text-muted">Dalam satuan Gram</small>
                                @error('berat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi" class="col-sm-2 control-label">Deskripsi Produk</label>
                            <div class="col-sm-10">
                                <input type="hidden" id="deskripsi" name="deskripsi" value="{{ old('deskripsi', @$produk->deskripsi) }}" class="@error('deskripsi') is-invalid @enderror">
                                <trix-editor input="deskripsi"></trix-editor>
                                @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Upload Image Produk</label>
                            <input type="hidden" value="{{ @$produk->gambar }}" name="oldgambar">
                            <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" {{ @$produk->gambar ? '' : 'required' }} accept="image/*" onchange="loadFile(event,`avatarPreview`)">
                            <div class="mt-3">
                                <img src="{{ @$produk->gambar ? asset('storage/' . $produk->gambar) : '' }}" alt="" id="avatarPreview" class="rounded img-fluid col-sm-7"><br>
                            </div>
                            @error('gambar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
<script>
    document.addEventListener('trix-file-accept',(e) => {
        e.preventDefault()
    })

    var loadFile = function(event,target) {
        var avatar = document.getElementById(target);
        avatar.src = URL.createObjectURL(event.target.files[0]);
        avatar.onload = function() {
            URL.revokeObjectURL(avatar.src) // free memory
        }
    };
</script>
@endsection
