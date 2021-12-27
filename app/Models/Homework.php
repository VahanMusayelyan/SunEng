<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;

    protected $table = 'homeworks';

    protected $fillable = [
        'lesson_id',
        'homework_id',
    ];

    public function homeworkName(){
        return $this->belongsTo(HomeworkList::class, "homework_id");
    }

    public function lessonName(){
        return $this->belongsTo(Lesson::class, "lesson_id");
    }
}
