<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;
    protected $connection= 'portal_office';

    protected $primaryKey = 'id';
    public $table = 'antrian';
    // public $timestamps = false;
    public $incrementing = false;

    public $fillable = [
        'id',
        'nik',
        'name',
        'email',
        'departemen',
        'bagian',
        'dept_tujuan',
        'keperluan',
        'no_urut',
        'tgl_input',
        'status',
    ];
}
