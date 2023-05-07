<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\{Produk,Transaksi,User};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('admin.dashboard.index',[
            'config' => [
                'title' => 'Dashboard Page'
            ],
            'produk' => Produk::count(),
            'users' => User::latest()->with('roles')->whereNot('roles_id',1)->count(),
            'transSuccess' => Transaksi::where('status_transaksi','1'),
            'transaksi' => Transaksi::latest()->withCount(['transaksi_pembayaran' => function(Builder $query){
                $query->whereNotNull('bukti_pembayaran');
            }])
        ]);
    }
}
