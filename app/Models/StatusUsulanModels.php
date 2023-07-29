<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusUsulanModels extends Model
{
    protected $table = 'status_usulan';

    protected $fillable = ['status', 'user_id', 'nama', 'photo', 'created_at', 'updated_at'];

    use HasFactory;
}
