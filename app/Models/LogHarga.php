<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogHarga extends Model
{
    use HasFactory;

    protected $table = 'log_harga';

    protected $fillable = [
        'kode',
        'tanaman_id',
        'harga_beli',
    ];
}
