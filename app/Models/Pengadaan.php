<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    use HasFactory;

    protected $table = 'pengadaan';

    protected $fillable = [
        'user_id',
        'supplier_id',
        'tgl_pengadaan',
        'kode_pengadaan',
        'total',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function detail_pengadaan()
    {
        return $this->hasMany(DetailPengadaan::class);
    }
}
