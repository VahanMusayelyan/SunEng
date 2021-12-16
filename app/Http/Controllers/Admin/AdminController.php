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
}
