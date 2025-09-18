<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $table = 'master_role';
    protected $primaryKey = 'role_id';

    protected $fillable = [
        'role_id',
        'nama',
        'created_by',
        'updated_by',
    ];

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
