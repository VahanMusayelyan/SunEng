<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatchTask extends Model
{
    use HasFactory;

    protected $table = "catch_tasks";

    protected $fillable = [
        "catch_text", "word", "slide_lesson_id"
    ];
}
