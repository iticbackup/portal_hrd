<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceWeb extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection= 'portal_office';

    protected $primaryKey = 'id';
    public $table = 'maintenance_web';

    public $fillable = [
        'id',
        'name',
        'secret',
        'status',
        'mode',
    ];
}
