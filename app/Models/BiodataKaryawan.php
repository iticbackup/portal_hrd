<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BiodataKaryawan extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection= 'emp';
    protected $primaryKey = 'nik';
    public $table = 'biodata_karyawan';
    // public $timestamps = false;
    public $incrementing = false;
    // public $table = 'biodata_karyawan';
    protected $dates = ['deleted_at'];
    public $fillable = [
        'nik',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'alamat',
        'jenis_kelamin',
        'id_posisi',
        'id_jabatan',
        'id_departemen',
        'id_departemen_bagian',
        'departemen_dept',
        'departemen_bagian',
        'departemen_level',
        'rekening',
        'credit',
        'agama',
        'status_klg',
        'no_npwp',
        'no_telp',
        'no_bpjs_ketenagakerjaan',
        'no_bpjs_kesehatan',
        'no_rekening_mandiri',
        'no_rekening_bws',
        'no_rekening_bca',
        'golongan_darah',
        'pendidikan',
        'email',
        'kunci_loker',
        'sim_kendaraan',
        'pin',
        'kewarganegaraan',
        'foto_karyawan',
        'tanggal_masuk',
    ];

    // public function satuan_kerjas()
    // {
    //     return $this->belongsTo(\App\Models\IticDepartemen::class, '7');
    // }
    public function hrga_biodata_karyawan()
    {
        return $this->belongsTo(\App\Models\HrgaBiodataKaryawan::class, 'nik','nik');
    }

    public function hrga_biodata_karyawanss()
    {
        return $this->belongsTo(\App\Models\HrgaBiodataKaryawan::class, 'nik','nik');
    }

    public function log_posisi()
    {
        return $this->belongsTo(\App\Models\LogPosisi::class, 'nik','nik');
    }

    public function relasi_departemen()
    {
        // return $this->belongsTo(\App\Models\IticDepartemen::class, 'satuan_kerja','id_departemen');
        return $this->belongsTo(\App\Models\EmpDepartemen::class, 'id_departemen','id');
    }

    public function relasi_jabatan()
    {
        return $this->belongsTo(\App\Models\EmpJabatan::class, 'id_jabatan','id');
    }

    public function relasi_departemen_bagian()
    {
        // return $this->belongsTo(\App\Models\IticDepartemen::class, 'satuan_kerja','id_departemen');
        return $this->belongsTo(\App\Models\EmpDepartemenBagian::class, 'id_departemen_bagian','id');
    }

    public function posisi()
    {
        return $this->belongsTo(\App\Models\EmpPosisi::class, 'id_posisi','id');
    }
}
