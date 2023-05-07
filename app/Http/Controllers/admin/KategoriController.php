<?php

namespace App\Http\Controllers\admin;

use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
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
        return view('admin.kategori.index',[
            'config' => [
                'title' => 'Kategori Pages'
            ],
            'kategori' => Kategori::orderBy('kategori','ASC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategori.form',[
            'config' => [
                'title' => 'Form Kategori Pages'
            ],
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
            'kategori' => 'required|string|unique:kategori',
        ]);

        $valid['slug'] = SlugService::createSlug(Kategori::class, 'slug', $valid['kategori']);

        $is_success = Kategori::create($valid);
        if ($is_success) {
            return redirect('/admin/kategori')->with('notif','
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-check"></i> Successfull Create!</h4>
                Data Kategori Berhasil di Tambah ke Record!
            </div>');
        }else{
            return redirect('/admin/kategori/create')->with('notif','
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-ban"></i> Unsuccessful Create!</h4>
                Data Kategori Gagal di Tambah ke Record, silahkan periksa kembali!
            </div>');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.form',[
            'config' => [
                'title' => 'Form Kategori Pages'
            ],
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $valid = $request->validate([
            'kategori' => 'required|string|unique:kategori',
        ]);

        $valid['slug'] = SlugService::createSlug(Kategori::class, 'slug', $valid['kategori']);

        $is_success = Kategori::where('id', $kategori->id)->update($valid);
        if ($is_success) {
            return redirect('/admin/kategori')->with('notif','
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-check"></i> Successfull Update!</h4>
                Data Kategori Berhasil di Update ke Record!
            </div>');
        }else{
            return redirect("/admin/kategori/{$kategori->slug}/edit")->with('notif','
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-ban"></i> Unsuccessful Update!</h4>
                Data Kategori Gagal di Update ke Record, silahkan periksa kembali!
            </div>');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        $is_success = Kategori::destroy($kategori->id);
        if ($is_success) {
            return redirect('/admin/kategori')->with('notif','
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-check"></i> Successfull Delete!</h4>
                Data Kategori Berhasil di Delete dari Record!
            </div>');
        }else{
            return redirect("/admin/kategori")->with('notif','
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-ban"></i> Unsuccessful Delete!</h4>
                Data Kategori Gagal di Delete dari Record, silahkan periksa kembali!
            </div>');
        }
    }
}
