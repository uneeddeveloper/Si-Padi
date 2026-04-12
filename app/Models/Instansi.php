<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $fillable = ['nama', 'bidang', 'kontak', 'email', 'alamat', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
