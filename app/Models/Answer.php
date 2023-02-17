<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable =[
        'answer',
        'quize_id',
        'question_id',
        'is_right_answer',
    ];

    public function question()
    {
        return $this->belongsTo('App\Models\Question','question_id','id');
    }

}
