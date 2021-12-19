<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = "courses";

    protected $fillable = [
        "course_id",
        "course",
    ];

    public function children() {
        return $this->hasMany(Course::class, 'course_id');
    }
}