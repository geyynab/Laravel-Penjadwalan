<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WktTdkBersedia extends Model
{
    use HasFactory;
    protected $table = 'wkt_tdk_bersedia';
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'id_dosen', 'id_hari', 'id_jam'
    ];
}
