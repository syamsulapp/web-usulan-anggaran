<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rincian extends Model
{
    use HasFactory;

    protected $fillable = [
        'uraian_id',
        'pagu_id',
        'users_id',
        'nama_barang',
        'volume',
        'harga_satuan',
        'satuan',
        'total',
    ];
}
