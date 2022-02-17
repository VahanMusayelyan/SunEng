<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SplitTask extends Model
{
    use HasFactory;

    protected $table = 'split_tasks';

    protected $fillable = [
        'slide_lesson_id',
        'split_text'
    ];
}
