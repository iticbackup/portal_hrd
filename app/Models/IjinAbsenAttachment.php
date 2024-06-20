<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IjinAbsenAttachment extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $table = 'ijin_absen_attachment';
    public $incrementing = false;

    public $fillable = [
        'id',
        'ijin_absen_id',
        'attachment',
    ];

    // public function users()
    // {
    //     return $this->belongsTo(\App\Models\User::class, 'nik','nik');
    // }

    // public function biodata_karyawan()
    // {
    //     return $this->belongsTo(\App\Models\BiodataKaryawan::class, 'nik','nik');
    // }

    // public function ijin_absen_ttd()
    // {
    //     return $this->belongsTo(\App\Models\IjinAbsenTTD::class, 'id','ijin_absen_id');
    // }
}
