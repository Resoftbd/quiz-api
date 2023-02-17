<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable =[
        'question',
        'quize_id',
    ];

    public function quize()
    {
        return $this->belongsTo('App\Models\Quize','quize_id','id');
    }

    public function answer()
    {
        return $this->hasMany('App\Models\Answer');
    }

}
