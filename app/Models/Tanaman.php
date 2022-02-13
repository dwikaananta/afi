<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    use HasFactory;

    protected $table = 'tanaman';

    protected $fillable = [
        'kategori',
        // 'kode',
        'nama',
        'img',
        'harga_beli',
        'harga_jual',
        'stok',
        'status',
    ];

    public function log_harga()
    {
        return $this->hasMany(LogHarga::class);
    }
}
