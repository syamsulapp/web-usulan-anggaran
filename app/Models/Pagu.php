<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagu extends Model
{
    use HasFactory;
    protected $table = 'pagu';
    public $timestamps = false;
    protected $fillable = [
        'jenis_alokasi_anggaran',
        'anggaran_kodeakun',
    ];


    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class, 'anggaran_kodeakun', 'id');
    }
}
