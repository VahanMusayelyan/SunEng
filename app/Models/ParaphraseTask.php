<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParaphraseTask extends Model
{
    use HasFactory;

    protected $table = 'paraphrase_tasks';

    protected $fillable = [
        'slide_lesson_id', 'phrase_text', 'correct', 'example'
    ];
}
