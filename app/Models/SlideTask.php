<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideTask extends Model
{
    use HasFactory;

    protected $table = 'slides_tasks';

    protected $fillable = [
        'slide_id',
        'task'
    ];
}
