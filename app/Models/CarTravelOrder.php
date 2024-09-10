<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarTravelOrder extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'id';
    public $table = 'car_travel_order';
    // public $timestamps = false;
    public $incrementing = false;

    public $fillable = [
        'id',
        'tanggal_buat',
        'no_polisi',
        'driver_id',
        'jam_berangkat_rencana',
        'jam_datang_rencana',
        'jam_berangkat_aktual',
        'jam_datang_aktual',
        'tujuan_rencana',
        'tujuan_aktual',
        'keperluan',
        'ttd_umum',
        'ttd_pemakai',
        'penumpang',
        'security_jam_keluar',
        'security_km_keluar',
        'security_ttd_keluar',
        'security_jam_masuk',
        'security_km_masuk',
        'security_ttd_masuk',
        'status',
    ];

    public function biodata_karyawan()
    {
        return $this->belongsTo(\App\Models\BiodataKaryawan::class, 'driver_id', 'id');
    }
}
