<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralTask;
use Illuminate\Http\Request;

class AdminTaskController extends Controller
{

    public function getGeneralTasks($lessonSlideId = null)
    {
        if(!$lessonSlideId){
            $lessonSlideId = request()->lessonSlideId;
        }
        return response()->json([
            "generalTasks" => GeneralTask::where('slide_lesson_id', $lessonSlideId)->get()->toArray()
        ]);
    }

    public function addGeneralTask(Request $request)
    {

        if($request->id && $request->id > 0){

            $addTask = GeneralTask::where("id", $request->id)
                ->update([
                'quest'           => $request->questionGeneral
            ]);
        }else{
            $addTask = GeneralTask::insert([
                'slide_lesson_id' => $request->lessonSlideId,
                'quest'           => $request->questionGeneral
            ]);
        }


        if ($addTask) {
            return $this->getGeneralTasks($request->lessonSlideId);
        }

        return response()->json(0);

    }

    public function editGeneralTask(Request $request)
    {
        return response()->json(GeneralTask::where('id', $request->id)->first());

    }

    public function deleteGeneralTask(Request $request)
    {
        GeneralTask::where("id", $request->id)->delete();

        return $this->getGeneralTasks($request->lessonSlideId);

    }
}
