<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelTest extends Model
{
    use HasFactory;
    // protected $primaryKey = 'id';
    public $table = 'excel';
    // public $timestamps = false;
    // public $incrementing = false;

    public $fillable = [
        'id_generate',
        'nik',
        'name',
        'email',
        'email_verified_at',
        'password',
        'last_seen',
        'departemen',
    ];
}
