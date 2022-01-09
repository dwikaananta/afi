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
    ];
}
