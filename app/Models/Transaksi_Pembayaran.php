<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi_Pembayaran extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'transaksi_pembayaran';

    public function payment()
    {
        return $this->hasOne(Transaksi::class);
    }
}
