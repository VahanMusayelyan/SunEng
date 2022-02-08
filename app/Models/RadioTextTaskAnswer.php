<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioTextTaskAnswer extends Model
{
    use HasFactory;

    protected $table = "radio_text_tasks_answers";

    protected $fillable = ["radio_text_task_id", "answer", "correct"];
}
