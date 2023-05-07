<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'transaksi';

    protected $with = ['user','approveall','transaksi_pembayaran','detail_transaksi'];

    public function transaksi()
    {
        return DB::table('transaksi')
                    ->join('detail_transaksi', 'transaksi.id', '=', 'detail_transaksi.transaksi_id')
                    ->leftJoin('transaksi_pembayaran', 'transaksi.id', '=', 'transaksi_pembayaran.transaksi_id')
                    ->join('users', 'transaksi.user_id', '=', 'users.id')
                    ->join('produk', 'detail_transaksi.produk_id', '=', 'produk.id')
                    ->join('kategori', 'produk.ketegori_id', '=', 'kategori.id')
                    ->select('*')->get();
    }

    public function getRouteKeyName()
    {
        return 'kode_transaksi';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approveall()
    {
        return $this->belongsTo(User::class,'user_approve');
    }

    public function transaksi_pembayaran()
    {
        return $this->hasOne(Transaksi_Pembayaran::class);
    }

    public function detail_transaksi()
    {
        return $this->hasMany(Detail_Transaksi::class);
    }


}
