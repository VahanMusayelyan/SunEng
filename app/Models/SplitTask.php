<?php

namespace App\Models;

use App\Models\SplitTaskWord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SplitTask extends Model
{
    use HasFactory;

    protected $table = 'split_tasks';

    protected $fillable = [
        'slide_lesson_id',
        'split_text'
    ];

    public function words()
    {
        return $this->hasMany(SplitTaskWord::class, "split_task_id");
    }
}
