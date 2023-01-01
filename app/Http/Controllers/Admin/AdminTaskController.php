<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BooleanTask;
use App\Models\BooleanTaskReading;
use App\Models\CatchTask;
use App\Models\GeneralTask;
use App\Models\MultipleAnswer;
use App\Models\MultipleAnswerQuestion;
use App\Models\ParaphraseTask;
use App\Models\RadioTask;
use App\Models\RadioTaskAnswer;
use App\Models\RadioText;
use App\Models\RadioTextTask;
use App\Models\RadioTextTaskAnswer;
use App\Models\SplitTask;
use App\Models\SplitTaskWord;
use App\Models\TwoPartTask;
use App\Models\TwoPartTaskAnswer;
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
        try {
            GeneralTask::where("id", $request->id)->delete();

            return $this->getGeneralTasks($request->lessonSlideId);
        }catch(\Exception $e){
            return response()->json(0);
        }
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
        try {
            BooleanTask::where("id", $request->id)->delete();

            return $this->getBooleanTasks($request->lessonSlideId);
        }catch(\Exception $e){
            return response()->json(0);
        }
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

        if ($request->correct == true) {
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
        try {
            RadioTask::where("id", $request->id)->delete();

            return $this->getRadioTasks($request->lessonSlideId);
        }catch(\Exception $e){
            return response()->json(0);
        }
    }

    public function editRadioTask(Request $request)
    {
        return response()->json(RadioTask::where("id", $request->id)->first());
    }

    public function editRadioTaskAnswer(Request $request)
    {
        return response()->json(RadioTaskAnswer::where("id", $request->id)->first());
    }

    public function updateRadioTaskAnswer(Request $request)
    {

        if ($request->correct == true) {
            $correct = 1;
            $checkExistTrueAnswer = RadioTaskAnswer::where("radio_task_id", $request->radioTaskId)
                ->where("id", "!=", $request->id)
                ->where("correct", 1)->first();
            if (isset($checkExistTrueAnswer) && $checkExistTrueAnswer->id) {
                return response()->json(0);
            }
        } else {
            $correct = null;
        }

        RadioTaskAnswer::where("id", $request->id)->update([
            "answer" => $request->answer,
            "correct" => $request->correct,
        ]);

        return $this->getRadioTasks($request->lessonSlideId);
    }

    public function deleteRadioTaskAnswer(Request $request)
    {
        try {
            RadioTaskAnswer::where("id", $request->id)->delete();

            return $this->getRadioTasks($request->lessonSlideId);
        }catch(\Exception $e){
            return response()->json(0);
        }

    }

    public function getRadioTextTasks($lessonSlideId = null)
    {
        if (!$lessonSlideId) {
            $lessonSlideId = request()->lessonSlideId;
        }
        return response()->json(RadioText::where('slide_lesson_id', $lessonSlideId)->with("questions", "questions.answers")->first());
    }

    public function addRadioTextTask(Request $request)
    {
        $radioText = RadioText::where('slide_lesson_id', $request->lessonSlideId)->first();
        if ($radioText) {
            RadioText::where('slide_lesson_id', $request->lessonSlideId)->update([
                "radio_text" => $request->readingText,
            ]);
        } else {
            $radioText = new RadioText();
            $radioText->radio_text = $request->readingText;
            $radioText->slide_lesson_id = $request->lessonSlideId;
            $radioText->save();
        }

        $radioTextQuestion = new RadioTextTask();
        $radioTextQuestion->radio_text_id = $radioText->id;
        $radioTextQuestion->question = $request->question;
        $radioTextQuestion->save();

        if ($request->correct === true) {
            $correct = 1;
        } else {
            $correct = 0;
        }

        RadioTextTaskAnswer::insert([
            "radio_text_task_id" => $radioTextQuestion->id,
            "answer" => $request->answer,
            "correct" => $correct,
        ]);

        return $this->getRadioTextTasks($request->lessonSlideId);
    }

    public function editRadioTextTask(Request $request)
    {
        return response()->json(RadioTextTask::where("id", $request->id)->first());
    }

    public function updateRadioTextTask(Request $request)
    {
        try {
            RadioTextTask::where("id", $request->id)->update([
                "question" => $request->question
            ]);

            return $this->getRadioTextTasks($request->lessonSlideId);
        } catch (\Exception $e) {
            return response()->json(0);
        }
    }

    public function deleteRadioTextTask(Request $request)
    {
        try {
            RadioTextTask::where("id", $request->id)->delete();

            return $this->getRadioTextTasks($request->lessonSlideId);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json(0);
        }
    }

    public function editRadioTextTaskAnswer(Request $request)
    {
        return response()->json(RadioTextTaskAnswer::where("id", $request->id)->first());
    }

    public function updateRadioTextTaskAnswer(Request $request)
    {
        try {

            if ($request->correct == true) {
                $correct = 1;
                if ($request->choosenQuestion) {
                    $checkExistTrueAnswer = RadioTextTaskAnswer::where("radio_text_task_id", $request->choosenQuestion)->where("correct", 1)->first();
                    if (isset($checkExistTrueAnswer) && $checkExistTrueAnswer->id) {
                        return response()->json(0);
                    }
                }
            } else {
                $correct = null;
            }

            RadioTextTaskAnswer::where("id", $request->id)->update([
                "answer" => $request->answer,
                "correct" => $correct,
            ]);

            return $this->getRadioTextTasks($request->lessonSlideId);
        } catch (\Exception $e) {
            return response()->json(0);
        }
    }

    public function deleteRadioTextTaskAnswer(Request $request)
    {
        try {
            RadioTextTaskAnswer::where("id", $request->id)->delete();

            return $this->getRadioTextTasks($request->lessonSlideId);
        } catch (\Exception $e) {
            return response()->json(0);
        }
    }

    public function getSplitTasks($lessonSlideId = null)
    {
        if (!$lessonSlideId) {
            $lessonSlideId = request()->lessonSlideId;
        }
        return response()->json(SplitTask::with("words")->where('slide_lesson_id', $lessonSlideId)->get()->toArray());
    }

    public function addSplitTask(Request $request)
    {
        try {
            $questionSplit = $request->questionSplit;
            $questionSplitArr = explode(" ", $questionSplit);
            shuffle($questionSplitArr);

            $splitTask = new SplitTask();
            $splitTask->slide_lesson_id = $request->lessonSlideId;
            $splitTask->split_text = $questionSplit;
            $splitTask->save();

            foreach ($questionSplitArr as $word) {
                SplitTaskWord::insert([
                    'word' => $word,
                    'split_task_id' => $splitTask->id,
                ]);
            }

            return $this->getSplitTasks($request->lessonSlideId);
        } catch (\Exception $e) {
            return response()->json(0);
        }
    }

    public function editSplitTask(Request $request)
    {
        return response()->json(SplitTask::with("words")->where('id', $request->id)->first()->toArray());
    }

    public function updateSplitTask(Request $request)
    {
        try {
            SplitTask::where("id", $request->id)->delete();

            $questionSplit = $request->editSplit;
            $questionSplitArr = explode(" ", $questionSplit);
            shuffle($questionSplitArr);

            $splitTask = new SplitTask();
            $splitTask->slide_lesson_id = $request->lessonSlideId;
            $splitTask->split_text = $questionSplit;
            $splitTask->save();

            foreach ($questionSplitArr as $word) {
                SplitTaskWord::insert([
                    'word' => $word,
                    'split_task_id' => $splitTask->id,
                ]);
            }

            return $this->getSplitTasks($request->lessonSlideId);
        } catch (\Exception $e) {
            return response()->json(0);
        }
    }

    public function deleteSplitTask(Request $request)
    {
        try {
            SplitTask::where("id", $request->id)->delete();

            return $this->getSplitTasks($request->lessonSlideId);
        } catch (\Exception $e) {
            return response()->json(0);
        }
    }
    public function getCatchTasks($lessonSlideId = null)
    {
        if (!$lessonSlideId) {
            $lessonSlideId = request()->lessonSlideId;
        }
        return response()->json(CatchTask::where('slide_lesson_id', $lessonSlideId)->get()->toArray());
    }

    public function addCatchTask(Request $request)
    {
        try {
            $catchTask = new CatchTask();
            $catchTask->slide_lesson_id = $request->lessonSlideId;
            $catchTask->catch_text = $request->questionCatch;
            $catchTask->word = $request->word;
            $catchTask->save();

            return $this->getCatchTasks($request->lessonSlideId);
        } catch (\Exception $e) {
            return response()->json(0);
        }
    }

    public function editCatchTask(Request $request)
    {
        return response()->json(CatchTask::where('id', $request->id)->first()->toArray());
    }

    public function updateCatchTask(Request $request)
    {
        try {
            CatchTask::where("id", $request->id)->update([
                "catch_text" => $request->editCatch,
                "word" => $request->editWord
            ]);

            return $this->getCatchTasks($request->lessonSlideId);
        } catch (\Exception $e) {
            return response()->json(0);
        }
    }

    public function deleteCatchTask(Request $request)
    {
        try {
            CatchTask::where("id", $request->id)->delete();

            return $this->getCatchTasks($request->lessonSlideId);
        } catch (\Exception $e) {
            return response()->json(0);
        }
    }
    public function getPhraseTasks($lessonSlideId = null)
    {
        if (!$lessonSlideId) {
            $lessonSlideId = request()->lessonSlideId;
        }
        return response()->json(ParaphraseTask::where('slide_lesson_id', $lessonSlideId)->get()->toArray());
    }

    public function addPhraseTask(Request $request)
    {
        try {
            $catchTask = new ParaphraseTask();
            $catchTask->slide_lesson_id = $request->lessonSlideId;
            $catchTask->phrase_text = $request->questionPhrase;
            $catchTask->correct = $request->phraseCorrect;
            $catchTask->example = $request->phraseExample;
            $catchTask->save();

            return $this->getPhraseTasks($request->lessonSlideId);
        } catch (\Exception $e) {
            return response()->json(0);
        }
    }

    public function editPhraseTask(Request $request)
    {
        return response()->json(ParaphraseTask::where('id', $request->id)->first()->toArray());
    }

    public function updatePhraseTask(Request $request)
    {
        try {
            ParaphraseTask::where("id", $request->id)->update([
                "phrase_text" => $request->editPhrase,
                "correct" => $request->editCorrect,
                "example" => $request->editExample,
            ]);

            return $this->getPhraseTasks($request->lessonSlideId);
        } catch (\Exception $e) {
            return response()->json(0);
        }
    }

    public function deletePhraseTask(Request $request)
    {
        try {
            ParaphraseTask::where("id", $request->id)->delete();

            return $this->getPhraseTasks($request->lessonSlideId);
        } catch (\Exception $e) {
            return response()->json(0);
        }
    }

    public function getTwoPartTasks($lessonSlideId = null)
    {
        if (!$lessonSlideId) {
            $lessonSlideId = request()->lessonSlideId;
        }
        return response()->json(TwoPartTaskAnswer::with(["getFirstPart", "getSecondPart"])->where('slide_lesson_id', $lessonSlideId)->get()->toArray());
    }

    public function addTwoPartTask(Request $request)
    {
        try {
            $part = new TwoPartTask();
            $part->question = $request->questionFirst;
            $part->save();

            $firstId = $part->id;

            $part = new TwoPartTask();
            $part->question = $request->questionSecond;

            $part->save();

            $secondId = $part->id;

            TwoPartTaskAnswer::insert([
                "question_first"  => $firstId,
                "question_second" => $secondId,
                "slide_lesson_id" => $request->lessonSlideId,

            ]);
            return $this->getTwoPartTasks($request->lessonSlideId);

        } catch (\Exception $e) {
            return response()->json(0);
        }
    }

    public function editTwoPartTask(Request $request)
    {
        return response()->json(TwoPartTaskAnswer::with(["getFirstPart", "getSecondPart"])->where('id', $request->id)->first()->toArray());
    }

    public function updateTwoPartTask(Request $request)
    {
        try {
            $editTwoPart = TwoPartTaskAnswer::where("id", $request->id)->first();

            TwoPartTask::where("id", $editTwoPart->question_first)->update([
               "question" => $request->editQuestionFirst
            ]);

            TwoPartTask::where("id", $editTwoPart->question_second)->update([
               "question" => $request->editQuestionSecond
            ]);

            return $this->getTwoPartTasks($request->lessonSlideId);

        } catch (\Exception $e) {
            return response()->json(0);
        }
    }

    public function deleteTwoPartTask(Request $request)
    {
        try {
            $editTwoPart = TwoPartTaskAnswer::where("id", $request->id)->first();

            TwoPartTask::where("id", $editTwoPart->question_first)->delete();

            TwoPartTask::where("id", $editTwoPart->question_second)->delete();

            return $this->getTwoPartTasks($request->lessonSlideId);
        } catch (\Exception $e) {
            return response()->json(0);
        }
    }

    public function getMultipleAnswersTasks($lessonSlideId = null)
    {
        if(isset(request()->lessonSlideId)){
            $lessonSlideId = request()->lessonSlideId;
        }
        return response()->json(MultipleAnswerQuestion::select()->with("answers")->where('slide_lesson_id', $lessonSlideId)->get()->toArray());
    }

    public function addMultipleQuestionTask(Request $request)
    {
        try {
            $multipleAnswerQuestion = new MultipleAnswerQuestion;
            $multipleAnswerQuestion->slide_lesson_id = $request->lessonSlideId;
            $multipleAnswerQuestion->question = $request->multipleQuestion;
            $multipleAnswerQuestion->save();

            MultipleAnswer::insert([
               "mult_ans_quest_id" => $multipleAnswerQuestion->id,
               "answer" => $request->answerMultipleText,
               "correct" => $request->answerMultipleTrueText,
            ]);

            return $this->getMultipleAnswersTasks($request->lessonSlideId);
        }catch (\Exception $e) {
            return response()->json(0);
        }



    }

}
