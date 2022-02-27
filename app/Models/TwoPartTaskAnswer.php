<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwoPartTaskAnswer extends Model
{
    use HasFactory;

    protected $table = "two_part_tasks_answers";

    protected $fillable = [
        "question_first", "question_second"
    ];

    public function getFirstPart(){
        return $this->belongsTo(TwoPartTask::class, "question_first", "id");
    }

    public function getSecondPart(){
        return $this->belongsTo(TwoPartTask::class, "question_second", "id");
    }
}
