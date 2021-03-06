<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralTask extends Model
{
    use HasFactory;

    protected $table = "general_tasks";

    protected $fillable = [
      'reading_id', 'question'
    ];
}
