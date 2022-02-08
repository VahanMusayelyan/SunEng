<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioTextTask extends Model
{
    use HasFactory;

    protected $table = "radio_text_tasks";

    protected $fillable = ["question", "slide_lesson_id", "text_id"];


    public function answers()
    {
        return $this->hasMany(RadioTextTaskAnswer::class, "radio_text_task_id");
    }

    public function text()
    {
        return $this->belongsTo(RadioText::class, "radio_text_id");
    }
}
