<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Homework;
use App\Models\HomeworkList;
use App\Models\Lesson;
use App\Models\Slide;
use App\Models\SlideList;
use Illuminate\Http\Request;

class AdminLessonController extends Controller
{
    public function index(Request $request){
        return response()->json([
            'lessons' => Lesson::with("course.parent")->where('course_id', $request->course_id)->get()->toArray(),
            'course' => Course::with("parent")->where('id', $request->course_id)->first(),
        ]);
    }

    public function lessonsList(){
        $lessons = Lesson::with("course.parent")->get()->toArray();

        $course = Course::with("children")->where("course_id", "0")->get()->toArray();

        return response()->json([
            'lessons' => $lessons,
            'course' => $course,
        ]);
    }

    public function addLesson(Request $request)
    {

        Lesson::insert([
            "lesson"    => $request->lesson,
            "course_id" => $request->subcourse,
        ]);

        $lessons = Lesson::with("course.parent")->get()->toArray();

        return $this->lessonsList();
    }

    public function editLesson(Request $request)
    {
        return response()->json(Lesson::with("course")->where("id", $request->id)->first());
    }

    public function updateLesson(Request $request)
    {
        Lesson::where("id", $request->id)->update([
           "lesson"    => $request->lesson,
           "course_id" => $request->course_id,
        ]);

        return $this->lessonsList();
    }

    public function deleteLesson(Request $request)
    {
        Lesson::where("id", $request->id)->delete();

        return $this->lessonsList();
    }

    public function lessonShow(Request $request)
    {
        return response()->json([
            'lesson' => Lesson::with("course.parent")->where("id", $request->id)->first()
        ]);
    }

    public function lessonTitle(Request $request)
    {
        Lesson::where("id", $request->id)->update([
           'title' => $request->title
        ]);
        return response()->json([
            'lesson' => Lesson::with("course.parent")->where("id", $request->id)->first()
        ]);
    }

    public function getSlides()
    {
        return response()->json([
            "slides" => SlideList::all()
        ]);
    }
    public function addSlide(Request $request)
    {
        SlideList::insert(['slide' => $request->slide]);

        return $this->getSlides();
    }

    public function getHomeworks()
    {
        return response()->json([
            "homeworks" => HomeworkList::all()
        ]);
    }

    public function addHomework(Request $request)
    {
        HomeworkList::insert(['homework' => $request->homework]);

        return $this->getHomeworks();
    }

    public function addLessonSlide(Request $request)
    {
        $lessonId = $request->lesson_id;

        foreach ($request->slides as $slide){
            Slide::insert([
                "slide_id" => $slide,
                "lesson_id" => $lessonId,
            ]);
        }
        return $this->listSlidesHomeworks();
    }

    public function addLessonHomework(Request $request)
    {
        $lessonId = $request->lesson_id;
        foreach ($request->homeworks as $homework){
            Homework::insert([
                "homework_id" => $homework,
                "lesson_id" => $lessonId,
            ]);
        }
        return $this->listSlidesHomeworks($lessonId);
    }

    public function listSlidesHomeworks($lessonId = null)
    {
        if($lessonId){
            return response()->json([
                'slidesLesson' => Slide::where('lesson_id', $lessonId)->with('slideName')->get()->toArray(),
                'homeworksLesson' => Homework::where('lesson_id', $lessonId)->with('homeworkName')->get()->toArray(),
            ]);
        }

        return response()->json([
            'slidesLesson' => Slide::where('lesson_id', request()->lesson_id)->with('slideName')->get()->toArray(),
            'homeworksLesson' => Homework::where('lesson_id', request()->lesson_id)->with('homeworkName')->get()->toArray(),
        ]);
    }

    public function deleteLessonWork(Request $request)
    {
        Homework::where('id', $request->id)->delete();

        return $this->listSlidesHomeworks($request->lesson_id);
    }

    public function deleteLessonSlide(Request $request)
    {
        Slide::where('id', $request->id)->delete();

        return $this->listSlidesHomeworks($request->lesson_id);
    }
}
