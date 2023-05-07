<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\{Produk,Kategori};
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.produk.index',[
            'config' => [
                'title' => 'Produk Pages'
            ],
            // 'products' => Produk::latest()->get()
            'products' => Produk::latest()
                        // ->whereHas('kategori', function($query)  {
                        //     $query->where('deleted_at', NULL);
                        // })
                        ->get()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.produk.form',[
            'config' => [
                'title' => 'Form Produk Pages'
            ],
            'kategori' => Kategori::where('deleted_at', NULL)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'kode_produk' => 'required|max:10|unique:produk',
            'nama_produk' => 'required|min:3',
            'ketegori_id' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'discount' => 'required',
            'berat' => 'required',
            'deskripsi' => 'required',
            'satuan' => 'required',
            'gambar' => 'image|file|max:2048'
        ]);
        $valid['slug'] = SlugService::createSlug(Produk::class, 'slug', $valid['kode_produk'].' '.$valid['nama_produk']);

        if ($request->file('gambar')) {
            $filenameWithExt = $request->file('gambar')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            $valid['gambar'] = $request->file('gambar')->storeAs('public/post-produk',
            $filenameSimpan);
        }

        $is_success = Produk::create($valid);
        if ($is_success) {
            return redirect('/admin/produk')->with('notif','
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-check"></i> Successfull Create!</h4>
                Data Produk Berhasil di Tambah ke Record!
            </div>');
        }else{
            return redirect('/admin/produk/create')->with('notif','
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-ban"></i> Unsuccessful Create!</h4>
                Data Produk Gagal di Tambah ke Record, silahkan periksa kembali!
            </div>');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        return view('admin.produk.form',[
            'config' => [
                'title' => 'Form Produk Pages'
            ],
            'produk' => $produk,
            'kategori' => Kategori::where('deleted_at', NULL)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $rules = [
            'kode_produk' => 'required|max:10',
            'nama_produk' => 'required|min:3',
            'ketegori_id' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'discount' => 'required',
            'berat' => 'required',
            'deskripsi' => 'required',
            'satuan' => 'required',
            'gambar' => 'image|file|max:2048'
        ];

        $valid = $request->validate($rules);

        if ($request->nama_produk != $produk->nama_produk || $request->kode_produk != $produk->kode_produk) {
            $valid['slug'] = SlugService::createSlug(Produk::class, 'slug', $valid['kode_produk'].' '.$valid['nama_produk']);
        }


        if ($request->file('gambar')) {
            if ($request->oldgambar) {
                Storage::delete($request->oldgambar);
            }

            $filenameWithExt = $request->file('gambar')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            $valid['gambar'] = $request->file('gambar')->storeAs('public/post-produk',
            $filenameSimpan);
        }

        $is_success = Produk::where('id', $produk->id)->update($valid);

        if ($is_success) {
            return redirect('/admin/produk')->with('notif','
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-check"></i> Successfull Update!</h4>
                Data Produk Berhasil di Update ke Record!
            </div>');
        }else{
            return redirect("/admin/produk/{$produk->kode_produk}/edit")->with('notif','
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-ban"></i> Unsuccessful Update!</h4>
                Data Produk Gagal di Update ke Record, silahkan periksa kembali!
            </div>');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        $is_success = Produk::destroy($produk->id);
        if ($is_success) {
            return redirect('/admin/produk')->with('notif','
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-check"></i> Successfull Delete!</h4>
                Data Produk Berhasil di Delete dari Record!
            </div>');
        }else{
            return redirect("/admin/produk")->with('notif','
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-ban"></i> Unsuccessful Delete!</h4>
                Data Produk Gagal di Delete dari Record, silahkan periksa kembali!
            </div>');
        }
    }
}
