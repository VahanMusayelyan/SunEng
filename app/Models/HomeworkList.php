<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeworkList extends Model
{
    use HasFactory;

    protected $table = 'homeworks_list';

    protected $fillable = [
        'homework'
    ];
}
