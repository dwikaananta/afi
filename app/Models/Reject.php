<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reject extends Model
{
    use HasFactory;

    protected $table = 'reject';

    protected $fillable = [
        'tanaman_id',
        'qty',
        'total',
        'status',
        'tgl_reject',
    ];

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class);
    }
}
