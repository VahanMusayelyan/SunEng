<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class AdminLessonController extends Controller
{
    public function index(Request $request){
        return response()->json([
            'lessons' => Lesson::with("course.parent")->where('course_id', $request->course_id)->get()->toArray(),
            'course' => Course::with("parent")->where('id', $request->course_id)->first(),
        ]);
    }

    public function lessons_list(){
        $lessons = Lesson::with("course.parent")->get()->toArray();

        $course = Course::with("children")->where("course_id", "0")->get()->toArray();

        return response()->json([
            'lessons' => $lessons,
            'course' => $course,
        ]);
    }

    public function add_lesson(Request $request)
    {

        Lesson::insert([
            "lesson"    => $request->lesson,
            "course_id" => $request->subcourse,
        ]);

        $lessons = Lesson::with("course.parent")->get()->toArray();

        return $this->lessons_list();
    }

    public function edit_lesson(Request $request)
    {
        return response()->json(Lesson::with("course")->where("id", $request->id)->first());
    }

    public function update_lesson(Request $request)
    {
        Lesson::where("id", $request->id)->update([
           "lesson"    => $request->lesson,
           "course_id" => $request->course_id,
        ]);

        return $this->lessons_list();
    }

    public function delete_lesson(Request $request)
    {
        Lesson::where("id", $request->id)->delete();

        return $this->lessons_list();
    }
}
