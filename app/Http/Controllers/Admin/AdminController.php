<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        return view("main.index");
    }

    public function courses()
    {
        return response()->json(['cat' => Course::with('children')->orderBy('course_id', 'asc')->get()->toArray()]);
    }

    public function parent_courses()
    {
        return response()->json(['parent_courses' => Course::where("course_id", .0)->get()->toArray()]);
    }

    public function add_course(Request $request)
    {
        Course::insert([
            "course_id" => $request->parentId,
            "course"    => $request->courseName,
        ]);

        return $this->courses();
    }

    public function edit_course(Request $request)
    {
        return response()->json(['cat' => Course::where("id", $request->id)->first()]);

    }

    public function update_course(Request $request)
    {
        Course::where("id", $request->id)->update([
            "course_id" => $request->parentId,
            "course"    => $request->courseName,
        ]);

        return $this->courses();
    }

    public function add_main_course(Request $request)
    {
        Course::insert([
            "course_id" => 0,
            "course"    => $request->mainCourse,
        ]);

        return $this->courses();
    }

    public function edit_main_course(Request $request)
    {
        return response()->json(['cat' => Course::where("id", $request->id)->first()]);

    }

    public function update_main_course(Request $request)
    {
        Course::where("id", $request->id)->update([
            "course"    => $request->course,
        ]);

        return $this->courses();
    }
}
