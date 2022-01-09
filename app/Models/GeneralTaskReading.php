<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralTaskReading extends Model
{
    use HasFactory;

    protected $table = 'general_tasks_reading';

    protected $fillable = [
        'reading',
        'slide_lesson_id',
    ];

    public function questions(){
        return $this->hasMany(GeneralTask::class, "reading_id");
    }
}
