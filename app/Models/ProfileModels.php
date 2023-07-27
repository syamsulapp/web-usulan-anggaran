<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileModels extends Model
{
    use HasFactory;

    protected $table = 'profile';

    protected $fillable = ['nama_lengkap', 'about_me', 'education', 'location', 'skill', 'photos', 'id_users', 'created_at', 'updated_at'];
}
