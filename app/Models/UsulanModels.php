<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsulanModels extends Model
{
    protected $table = 'rincian';

    protected $fillable = [
        'uraian_id',
        'pagu_id',
        'user_id',
        'nama_barang',
        'volume',
        'harga_satuan',
        'satuan',
        'total',
        'created_at',
        'updated_at'
    ];

    use HasFactory;
}
