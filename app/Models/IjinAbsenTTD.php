<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IjinAbsenTTD extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $table = 'ijin_absen_ttd';
    public $incrementing = false;

    public $fillable = [
        'id',
        'ijin_absen_id',
        'signature_manager',
        'tgl_signature_manager',
        'signature_bersangkutan',
        'tgl_signature_bersangkutan',
        'signature_saksi_1',
        'tgl_signature_saksi_1',
        'signature_saksi_2',
        'tgl_signature_saksi_2',
    ];
}
