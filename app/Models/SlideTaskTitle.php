<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideTaskTitle extends Model
{
    use HasFactory;

    protected $table = 'slides_tasks_title';

    protected $fillable = [
        'slide_id',
        'task'
    ];
}
