<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwoPartTask extends Model
{
    use HasFactory;

    protected $table = "two_part_tasks";

    protected $fillable = ["slide_task_id", "question"];

}
