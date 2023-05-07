<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\{User, Roles};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
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
        return view('admin.users.index',[
            'config' => [
                'title' => 'User Pages'
            ],
            'users' => User::orderBy('roles_id','ASC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.form',[
            'config' => [
                'title' => 'Form User Pages'
            ],
            'roles' => Roles::all()
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
        $rules = [
            'nama_lengkap' => 'required|string|min:3',
            'username' => 'required|string|min:3|unique:users,username',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|string|min:5',
            'roles_id' => 'required'
        ];

        if (@$request->no_telp) {
            $rules['no_telp'] = 'required';
        }

        if (@$request->alamat) {
            $rules['alamat'] = 'required';
        }

        $valid = $request->validate($rules);

        $valid['password'] = Hash::make($valid['password']);
        $is_success = User::create($valid);
        if ($is_success) {
            return redirect('/admin/users')->with('notif','
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-check"></i> Successfull Create!</h4>
                Data User Berhasil di Tambah ke Record!
            </div>');
        }else{
            return redirect('/admin/users/create')->with('notif','
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-ban"></i> Unsuccessful Create!</h4>
                Data User Gagal di Tambah ke Record, silahkan periksa kembali!
            </div>');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.form',[
            'config' => [
                'title' => 'Form User Pages'
            ],
            'user' => $user,
            'roles' => Roles::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'nama_lengkap' => 'required|string|min:3',
            'username' => 'required|string|min:3|unique:users,username',
            'email' => 'required|email:dns|unique:users,email',
            'roles_id' => 'required'
        ];

        if (@$request->no_telp) {
            $rules['no_telp'] = 'required';
        }

        if (@$request->alamat) {
            $rules['alamat'] = 'required';
        }

        if (@$request->password) {
            $rules['password'] = 'required|string|min:5';
        }

        $valid = $request->validate($rules);

        if (@$request->password) {
            $valid['password'] = Hash::make($valid['password']);
        }
        
        $is_success = User::where('id', $user->id)->update($valid);
        if ($is_success) {
            return redirect('/admin/users')->with('notif','
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-check"></i> Successfull Update!</h4>
                Data User Berhasil di Update ke Record!
            </div>');
        }else{
            return redirect("/admin/users/{$user->username}/edit")->with('notif','
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-ban"></i> Unsuccessful Update!</h4>
                Data User Gagal di Update ke Record, silahkan periksa kembali!
            </div>');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $is_success = User::destroy($user->id);
        if ($is_success) {
            return redirect('/admin/users')->with('notif','
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-check"></i> Successfull Delete!</h4>
                Data User Berhasil di Delete dari Record!
            </div>');
        }else{
            return redirect("/admin/users")->with('notif','
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-ban"></i> Unsuccessful Delete!</h4>
                Data User Gagal di Delete dari Record, silahkan periksa kembali!
            </div>');
        }
    }
}
