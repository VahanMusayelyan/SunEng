<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BooleanTask extends Model
{
    use HasFactory;

    protected $table = "boolean_tasks";

    protected $fillable = [
        "lesson_id", "reading_id", "question", "answer"
    ];
}
