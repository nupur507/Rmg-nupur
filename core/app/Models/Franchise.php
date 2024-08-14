<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Franchise extends Authenticatable
{
    use SoftDeletes;
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $guarded = ['id'];
    protected $table = "franchises";


}
