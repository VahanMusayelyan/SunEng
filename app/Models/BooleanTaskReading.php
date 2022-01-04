<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BooleanTaskReading extends Model
{
    use HasFactory;

    protected $table = "boolean_tasks_reading";

    protected $fillable = [
        "reading"
    ];

    public function questions(){
        return $this->hasMany(BooleanTask::class);
    }
}
