<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BooleanTask;
use App\Models\BooleanTaskReading;
use App\Models\GeneralTask;
use App\Models\RadioTask;
use App\Models\RadioTaskAnswer;
use Illuminate\Http\Request;
use App\Models\GeneralTaskReading;

class AdminTaskController extends Controller
{

    public function getGeneralTasks($lessonSlideId = null)
    {
        if (!$lessonSlideId) {
            $lessonSlideId = request()->lessonSlideId;
        }
        return response()->json(GeneralTaskReading::where('slide_lesson_id', $lessonSlideId)->with("questions")->first());
    }

    public function addGeneralTask(Request $request)
    {

        $reading = GeneralTaskReading::where("slide_lesson_id", $request->lessonSlideId)->first();

        if (isset($reading->reading) && $reading->reading != "") {
            $reading->reading = $request->readingGeneral;
            $reading->slide_lesson_id = $request->lessonSlideId;
            $reading->save();
        } elseif (!isset($request->id)) {
            $reading = new GeneralTaskReading;
            $reading->reading = $request->readingGeneral;
            $reading->slide_lesson_id = $request->lessonSlideId;
            $reading->save();
        }


        if ($request->id && $request->id > 0) {

            $addTask = GeneralTask::where("id", $request->id)
                ->update([
                    'question' => $request->questionGeneral
                ]);
        } else {
            if ($request->questionGeneral != "") {
                $addTask = GeneralTask::insert([
                    'reading_id' => $reading->id,
                    'question' => $request->questionGeneral
                ]);
            }
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
        if (!$lessonSlideId) {
            $lessonSlideId = request()->lessonSlideId;
        }
        return response()->json(BooleanTaskReading::where('slide_lesson_id', $lessonSlideId)->with("questions")->first());
    }

    public function addBooleanTask(Request $request)
    {

        $reading = BooleanTaskReading::where("slide_lesson_id", $request->lessonSlideId)->first();

        if (isset($reading->reading) && $reading->reading != "") {
            $reading->reading = $request->readingBoolean;
            $reading->slide_lesson_id = $request->lessonSlideId;
            $reading->save();
        } else {
            $reading = new BooleanTaskReading;
            $reading->reading = $request->readingBoolean;
            $reading->slide_lesson_id = $request->lessonSlideId;
            $reading->save();
        }


        if ($request->id && $request->id > 0) {

            $addTask = BooleanTask::where("id", $request->id)
                ->update([
                    'question' => $request->questionBoolean,
                    'answer' => $request->answerBoolean,
                ]);
        } else {
            if ($request->questionBoolean != "") {
                $addTask = BooleanTask::insert([
                    'reading_id' => $reading->id,
                    'question' => $request->questionBoolean,
                    'answer' => $request->answerBoolean
                ]);
            }
        }


        if ($addTask) {
            return $this->getBooleanTasks($request->lessonSlideId);
        }

        return response()->json(0);
    }

    public function editBooleanTask(Request $request)
    {
        return response()->json(BooleanTask::where('id', $request->id)->first());

    }

    public function deleteBooleanTask(Request $request)
    {
        BooleanTask::where("id", $request->id)->delete();

        return $this->getBooleanTasks($request->lessonSlideId);

    }


    public function getRadioTasks($lessonSlideId = null)
    {
        if (!$lessonSlideId) {
            $lessonSlideId = request()->lessonSlideId;
        }
        return response()->json(RadioTask::where('slide_lesson_id', $lessonSlideId)->with("answers")->get()->toArray());
    }

    public function addRadioTask(Request $request)
    {
        $addTaskRadio = false;
        $updateTask = false;

        if ($request->answer == true) {
            $correct = 1;
            if ($request->choosenQuestion) {
                $checkExistTrueAnswer = RadioTaskAnswer::where("radio_task_id", $request->choosenQuestion)->where("correct", 1)->first();
                if (isset($checkExistTrueAnswer) && $checkExistTrueAnswer->id) {
                    return response()->json(0);
                }
            }
        } else {
            $correct = null;
        }
        if ($request->choosenQuestion) {
            $taskId = $request->choosenQuestion;
        } else {
            if ($request->id && $request->id > 0) {
                $updateTask = RadioTask::where("id", $request->id)
                    ->update([
                        'question' => $request->question
                    ]);
            } else {
                $addTask = new RadioTask();
                $addTask->slide_lesson_id = $request->lessonSlideId;
                $addTask->question = $request->question;
                $addTask->save();
                $taskId = $addTask->id;
            }

        }

        if ($request->id == null) {
            $addTaskRadio = new RadioTaskAnswer();
            $addTaskRadio->radio_task_id = $taskId;
            $addTaskRadio->answer = $request->answer;
            $addTaskRadio->correct = $request->correct;
            $addTaskRadio->save();
        }


        if ($addTaskRadio || $updateTask) {
            return $this->getRadioTasks($request->lessonSlideId);
        }

        return response()->json(0);
    }

    public function deleteRadioTask(Request $request)
    {
        RadioTask::where("id", $request->id)->delete();

        return $this->getRadioTasks($request->lessonSlideId);
    }

    public function editRadioTask(Request $request)
    {
        return response()->json(RadioTask::where("id", $request->id)->first());
    }

}
