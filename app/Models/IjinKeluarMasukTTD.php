<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IjinKeluarMasukTTD extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $table = 'ijin_keluar_masuk_ttd';
    public $incrementing = false;

    public $fillable = [
        'id',
        'ijin_keluar_masuk_id',
        'signature_manager',
        'tgl_signature_manager',
        'signature_personalia',
        'tgl_signature_personalia',
        'signature_kend_satpam',
        'tgl_signature_kend_satpam',
    ];
}
