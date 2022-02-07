<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioText extends Model
{
    use HasFactory;

    protected $table = "radio_texts";

    protected $fillable = ["radio_text"];


    public function answers()
    {
        return $this->hasMany(RadioTextTask::class, "radio_text_id");
    }
}
