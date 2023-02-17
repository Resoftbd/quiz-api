<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submit extends Model
{
    protected $fillable =[
        'question_id',
        'answer_id',
        'quize_id',
        'is_right_answer',
        'submission_email',
    ];



}
