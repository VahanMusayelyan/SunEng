<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioTaskAnswer extends Model
{
    use HasFactory;

    protected $table = "radio_tasks_answer";

    protected $fillable = ["radio_task_id", "answer", "correct"];
}
