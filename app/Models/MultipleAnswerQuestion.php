<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleAnswerQuestion extends Model
{
    use HasFactory;

    protected $table = ['multiple_answers_questions'];

    protected $fillable = ['slide_lesson_id', 'question'];
}
