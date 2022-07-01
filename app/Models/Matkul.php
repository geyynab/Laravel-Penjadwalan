<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;
    protected $table = 'matkul';
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'kode_mk', 'nama_mk', 'sks', 'semester', 'aktif', 'jenis'
    ];
}
