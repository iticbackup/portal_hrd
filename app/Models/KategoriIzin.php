<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriIzin extends Model
{
    use HasFactory,SoftDeletes;
    
    public $table = 'kategori_izin';
    // public $timestamps = false;
    // public $incrementing = false;

    public $fillable = [
        'kode',
        'nama_kategori',
        'deskripsi',
        'status',
    ];
}
