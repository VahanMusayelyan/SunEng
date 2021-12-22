<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideList extends Model
{
    use HasFactory;

    protected $table = 'slides_list';

    protected $fillable = [
        'slide'
    ];
}
