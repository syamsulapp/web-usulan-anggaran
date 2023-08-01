<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_rincian extends Model
{
    protected $table = 'detail_rincian';

    use HasFactory;

    protected $fillable = [
        'total',
        'user_id',
        'created_at',
        'updated_at',
    ];
}
