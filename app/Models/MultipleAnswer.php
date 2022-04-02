<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleAnswer extends Model
{
    use HasFactory;

    protected $table = ['multiple_answers'];

    protected $fillable = ['mult_ans_quest_id', 'answer', 'correct'];
}
