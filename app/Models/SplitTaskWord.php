<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SplitTaskWord extends Model
{
    use HasFactory;

    protected $table = 'split_tasks_words';

    protected $fillable = ["split_task_id", "word"];
}
