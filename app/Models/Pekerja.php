<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pekerja extends Model
{
    protected $table = 'pekerja';
    
    protected $fillable = [
        'nama',
        'umur',
        'jenis_kelamin',
        'alamat',
        'nomor_hp',
        'email',
        'skill'
    ];
}