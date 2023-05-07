<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    private $forHeader = [];
    public function __construct()
    {
        if (@auth()->user()->roles->slug == "administrator") {
            return redirect()->route('dashboard-admin');
        }

        $this->forHeader['menuSide'] = Kategori::all();
        $this->forHeader['menuCenter'] = Kategori::limit(6)->get();
    }

    public function index()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        $valid = $request->validate([
            'email' => 'required|string|min:4',
            'password' => 'required|min:4'
        ]);

        if (Auth::attempt($valid)) {
            $request->session()->regenerate();

            if (auth()->user()->roles->slug == 'administrator') {
                return redirect()->intended('/admin/dashboard');
            }else{
                return redirect()->intended('/');
            }
        }

        return back()->with('notif', '
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <h4><i class="icon fa fa-ban"></i> Error Login!</h4>
            Email or Password incorrect, please try again!
        </div>');
    }

    public function register()
    {
        return view('frontend.register',[
            'config' => [
                'title' => 'Home Pages',
                'menu' => $this->forHeader
            ]
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_lengkap' => 'required|string|min:3',
            'username' => 'required|string|min:3|unique:users,username',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|string|min:5',
            'no_telp' => 'required|min:5',
            'alamat' => 'required|min:5',
        ];

        $valid = $request->validate($rules);
        $valid['password'] = Hash::make($valid['password']);
        $is_success = User::create($valid);
        if ($is_success) {
            return redirect('/')->with('alert','
                <script>alert(`Successfull Register! You can Login now!`)</script>
            ');
        }else{
            return redirect('/register')->with('alert','
                <script>alert(`Unsuccessfull Register! Please check your submited data`)</script>
            ');
        }
    }

    public function logout(Request $request)
    {
        $route = (auth()->user()->roles->slug == 'administrator') ? 'login' : 'home';
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route($route);
    }
}
