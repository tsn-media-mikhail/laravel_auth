<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLE_ADMIN = 3;
    const ROLE_USER = 2;
    const ROLE_DISABLED = 1;

    protected $fillable = [
        'id',
        'name'
    ];
}
