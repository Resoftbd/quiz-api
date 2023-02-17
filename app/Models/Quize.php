<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quize extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    protected $fillable =[
        'name',
        'description',
        'status',
    ];


}
