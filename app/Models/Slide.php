<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $table = 'slides';

    protected $fillable = [
        'lesson_id',
        'slide_id',
    ];

    public function slideName(){
        return $this->belongsTo(SlideList::class, "slide_id");
    }

}
