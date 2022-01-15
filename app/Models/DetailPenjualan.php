<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $table = 'detail_penjualan';

    protected $fillable = [
        'tanaman_id',
        'penjualan_id',
        'qty',
        'harga_jual',
    ];

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class);
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
}
