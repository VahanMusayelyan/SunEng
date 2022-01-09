<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BooleanTask;
use App\Models\BooleanTaskReading;
use App\Models\GeneralTask;
use Illuminate\Http\Request;
use App\Models\GeneralTaskReading;

class AdminTaskController extends Controller
{

    public function getGeneralTasks($lessonSlideId = null)
    {
        if(!$lessonSlideId){
            $lessonSlideId = request()->lessonSlideId;
        }
        return response()->json(GeneralTaskReading::where('slide_lesson_id', $lessonSlideId)->with("questions")->first());
    }

    public function addGeneralTask(Request $request)
    {

        $reading = GeneralTaskReading::where("slide_lesson_id", $request->lessonSlideId)->first();

        if(isset($reading->reading) && $reading->reading != ""){
            $reading->reading = $request->readingGeneral;
            $reading->slide_lesson_id  = $request->lessonSlideId;
            $reading->save();
        }else{
            $reading = new GeneralTaskReading;
            $reading->reading = $request->readingGeneral;
            $reading->slide_lesson_id  = $request->lessonSlideId;
            $reading->save();
        }


        if($request->id && $request->id > 0){

            $addTask = GeneralTask::where("id", $request->id)
                ->update([
                'question' => $request->questionGeneral
            ]);
        }else{
            $addTask = GeneralTask::insert([
                'reading_id'      => $reading->id,
                'question'        => $request->questionGeneral
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


    public function getBooleanTasks($lessonSlideId = null)
    {
        if(!$lessonSlideId){
            $lessonSlideId = request()->lessonSlideId;
        }
        return response()->json(BooleanTaskReading::where('slide_lesson_id', $lessonSlideId)->with("questions")->first());
    }

    public function addBooleanTask (Request $request)
    {
        $reading = BooleanTaskReading::where("slide_lesson_id", $request->lessonSlideId)->first();

        if(isset($reading->reading) && $reading->reading != ""){
            $reading->reading = $request->readingBoolean;
            $reading->slide_lesson_id  = $request->lessonSlideId;
            $reading->save();
        }else{
            $reading = new BooleanTaskReading;
            $reading->reading = $request->readingBoolean;
            $reading->slide_lesson_id  = $request->lessonSlideId;
            $reading->save();
        }


        if($request->id && $request->id > 0){

            $addTask = BooleanTask::where("id", $request->id)
                ->update([
                    'question' => $request->questionBoolean
                ]);
        }else{
            $addTask = BooleanTask::insert([
                'reading_id' => $reading->id,
                'question'   => $request->questionBoolean,
                'answer'     => $request->answerBoolean
            ]);
        }


        if ($addTask) {
            return $this->getBooleanTasks($request->lessonSlideId);
        }

        return response()->json(0);
    }

}
