<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IjinKeluarMasuk extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection= 'portal_office';
    
    protected $primaryKey = 'id';
    public $table = 'ijin_keluar_masuk';
    public $incrementing = false;

    public $fillable = [
        'id',
        'no',
        'nik',
        'nama',
        'jabatan',
        'unit_kerja',
        'email',
        'keperluan',
        'kendaraan',
        'kategori_izin',
        'jam_kerja',
        'jam_rencana_keluar',
        'jam_datang',
        'kategori_keperluan',
        'status',
    ];

    // public function users()
    // {
    //     return $this->belongsTo(\App\Models\User::class, 'nik','nik');
    // }

    public function biodata_karyawan()
    {
        return $this->belongsTo(\App\Models\BiodataKaryawan::class, 'nik','nik');
    }

    public function ijin_keluar_masuk_ttd()
    {
        return $this->belongsTo(\App\Models\IjinKeluarMasukTTD::class, 'id','ijin_keluar_masuk_id');
    }

    public function telepon()
    {
        return $this->belongsTo(\App\Models\User::class, 'nik','nik');
    }
}
