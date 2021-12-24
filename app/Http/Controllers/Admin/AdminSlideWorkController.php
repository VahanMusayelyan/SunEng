<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeworkList;
use App\Models\SlideList;
use Illuminate\Http\Request;

class AdminSlideWorkController extends Controller
{
    public function getHomeworks()
    {
        return response()->json([
            'homeworks' => HomeworkList::all(),
        ]);
    }

    public function addHomework(Request $request)
    {
        HomeworkList::insert(['homework' => $request->homework]);

        return $this->getHomeworks();
    }

    public function editHomework(Request $request)
    {
        return response()->json([
            "homework" => HomeworkList::where("id", $request->id)->first(),
        ]);
    }

    public function updateHomework(Request $request)
    {
        HomeworkList::where("id", $request->id)->update([
            "homework" => $request->homework
        ]);

        return $this->getHomeworks();
    }

    public function deleteHomework(Request $request)
    {
        HomeworkList::where("id", $request->id)->delete();

        return $this->getHomeworks();
    }

    public function getSlides()
    {
        return response()->json([
            'slides' => SlideList::all(),
        ]);
    }

    public function addSlide(Request $request)
    {
        SlideList::insert(['slide' => $request->slide]);

        return $this->getSlides();
    }

    public function editSlide(Request $request)
    {
        return response()->json([
            "slide" => SlideList::where("id", $request->id)->first(),
        ]);
    }

    public function updateSlide(Request $request)
    {
        SlideList::where("id", $request->id)->update([
            "slide" => $request->slide
        ]);

        return $this->getSlides();
    }

    public function deleteSlide(Request $request)
    {
        SlideList::where("id", $request->id)->delete();

        return $this->getSlides();
    }


}
