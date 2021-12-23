<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    public function index()
    {

        return view("main.index");
    }

    public function courses()
    {
        return response()->json(['cat' => Course::with('children')->get()->toArray()]);
    }

    public function parent_courses()
    {
        return response()->json(['parent_courses' => Course::where("course_id", .0)->get()->toArray()]);
    }

    public function addCourse(Request $request)
    {
        Course::insert([
            "course_id" => $request->parentId,
            "course"    => $request->courseName,
        ]);

        return $this->courses();
    }

    public function editCourse(Request $request)
    {
        return response()->json(['cat' => Course::where("id", $request->id)->first()]);

    }

    public function updateCourse(Request $request)
    {
        Course::where("id", $request->id)->update([
            "course_id" => $request->parentId,
            "course"    => $request->courseName,
        ]);

        return $this->courses();
    }

    public function addMainCourse(Request $request)
    {
        Course::insert([
            "course_id" => 0,
            "course"    => $request->mainCourse,
        ]);

        return $this->courses();
    }

    public function editMainCourse(Request $request)
    {
        return response()->json(['cat' => Course::where("id", $request->id)->first()]);

    }

    public function updateMainCourse(Request $request)
    {
        Course::where("id", $request->id)->update([
            "course"    => $request->course,
        ]);

        return $this->courses();
    }

    public function deleteMainCourse(Request $request)
    {
        Course::where("id", $request->id)->delete();

        return $this->courses();
    }
}
