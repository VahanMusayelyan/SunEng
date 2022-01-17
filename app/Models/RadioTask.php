<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioTask extends Model
{
    use HasFactory;

    protected $table = "radio_tasks";

    protected $fillable = ["question","slide_lesson_id"];


    public function answers(){
        return $this->hasMany(RadioTaskAnswer::class, "radio_task_id");
    }
}
