<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $table = 'produk';

    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['search'] ?? false, function($query, $search){
            return $query->where('kode_produk','like', "%" .$search. "%")
                  ->orWhere('nama_produk','like', "%" .$search. "%");
        });

        $query->when($filter['category'] ?? false, function($query, $category){
            return $query->whereHas('kategori', function($query) use($category){
                $query->where('slug',$category);
            });
        });
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'ketegori_id')->withTrashed();
    }

    public function detail_transaksi()
    {
        return $this->hasMany(Detail_Transaksi::class);
    }

    public function getRouteKeyName()
    {
        return 'kode_produk';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_produk'
            ]
        ];
    }
}
