<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'anggaran';
    protected $fillable = [
        'keterangan'

    ];

    public function pagu()
    {
        return $this->hasOne(Pagu::class, 'anggaran_kodeakun', 'id');
    }
}
