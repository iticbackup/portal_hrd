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
        'attachment_written_letter',
        'attachment',
    ];

    public function ijin_absen()
    {
        return $this->belongsTo(\App\Models\IjinAbsen::class, 'ijin_absen_id','id');
    }

    // public function biodata_karyawan()
    // {
    //     return $this->belongsTo(\App\Models\BiodataKaryawan::class, 'nik','nik');
    // }

    // public function ijin_absen_ttd()
    // {
    //     return $this->belongsTo(\App\Models\IjinAbsenTTD::class, 'id','ijin_absen_id');
    // }
}
