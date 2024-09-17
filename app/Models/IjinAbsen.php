<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IjinAbsen extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'id';
    public $table = 'ijin_absen';
    public $incrementing = false;

    public $fillable = [
        'id',
        'no',
        'nik',
        'nama',
        'jabatan',
        'unit_kerja',
        'email',
        'hari',
        'tgl_mulai',
        'tgl_berakhir',
        'kategori_izin',
        'selama',
        'keperluan',
        'saksi_1',
        'saksi_2',
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

    public function ijin_absen_ttd()
    {
        return $this->belongsTo(\App\Models\IjinAbsenTTD::class, 'id','ijin_absen_id');
    }

    public function ijin_absen_attachment()
    {
        return $this->belongsTo(\App\Models\IjinAbsenAttachment::class, 'id','ijin_absen_id');
    }

    public function telepon()
    {
        return $this->belongsTo(\App\Models\User::class, 'nik','nik');
    }
}
