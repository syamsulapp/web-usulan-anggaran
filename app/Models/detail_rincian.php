<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_rincian extends Model
{
    use HasFactory;

    protected $fillable = [
        'hasil',
        'rincian_id'
    ];
}
