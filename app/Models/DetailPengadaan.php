<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengadaan extends Model
{
    use HasFactory;

    protected $table = 'detail_pengadaan';

    protected $fillable = [
        'tanaman_id',
        'pengadaan_id',
        'qty',
        'harga_beli',
    ];

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class);
    }
}
