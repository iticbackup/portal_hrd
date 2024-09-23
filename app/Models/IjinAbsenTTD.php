<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IjinAbsenTTD extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection= 'portal_office';
    
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
