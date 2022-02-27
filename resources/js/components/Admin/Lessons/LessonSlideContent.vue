<template>
    <div class="w-100 d-inline-block content-dashboard">
        <h4 v-if="lessonSlide">Slide - {{ lessonSlide.slide_name.slide }}</h4>
        <div class="d-flex">
            <div class="w-25 mt-3 border p-3">
                <select class="custom-select" v-model="typeId" @change="chooseType" name="types" id="types">
                    <option :value="null"> Choose task type</option>
                    <option v-for="(type , ind) in taskTypes" :value="type.id">{{ type.id }} {{ type.type }}</option>
                </select>
                <div class="mt-5" v-if="radioTasksQuestion">
                    <select ref="choosenQuestion" class="custom-select" v-model="choosenQuestion" @change="chooseQuestion" name="questionAll" id="questionAll">
                        <option :value="null"> Choose question </option>
                        <option v-for="(questionItem , ind) in radioTasksQuestion" :value="questionItem.id">{{ questionItem.question }}</option>
                    </select>
                </div>
                <div class="mt-5" v-if="radioTasksTextQuestion && radioTasksTextQuestion.questions && radioTasksTextQuestion.questions.length > 0">
                    <select ref="choosenTextQuestion" class="custom-select" v-model="choosenTextQuestion" @change="chooseQuestionText" name="questionTextAll" id="chooseTextQuestion">
                        <option :value="null"> Choose question </option>
                        <option v-for="(questionItem , ind) in radioTasksTextQuestion.questions" :value="questionItem.id">{{ questionItem.question }}</option>
                    </select>
                </div>

            </div>
            <!-- Boolean tasks -->
            <div id="blockFirst" class="w-75 mt-3 ml-5  border p-3 blocksTasks">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Write reading text</span>
                        </div>
                        <textarea class="form-control" name="text" v-model="readingBoolean" id="text" cols="10"
                                  rows="6"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="question">Please write question</label>
                    <input autocomplete="off" class="form-control" v-model="questionBoolean" id="question">
                </div>
                <div class="form-group">
                    <label for="answerBoolean">Correct Answer</label>
                    <select id="answerBoolean" class="custom-select" v-model="answerBoolean">
                        <option value="1">True</option>
                        <option value="0">False</option>
                    </select>
                </div>
                <div class="form-group">
                    <button @click="addBooleanTask()" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- End Boolean tasks -->
            <!-- General tasks -->
            <div id="blockSecond" class="w-75 mt-3 ml-5  border p-3 blocksTasks">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Write reading text</span>
                        </div>
                        <textarea class="form-control" name="text" v-model="readingGeneral" id="textGeneral" cols="10"
                                  rows="6"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="question">Please write question</label>
                    <input autocomplete="off" class="form-control" v-model="questionGeneral" id="questionGeneral">
                </div>
                <div class="form-group">
                    <button @click="addGeneralTask()" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- End General tasks -->

            <!-- Radio tasks -->
            <div id="blockThird" class="w-75 mt-3 ml-5  border p-3 blocksTasks">
                <div class="form-group">
                    <label for="questionRadio">Please write question</label>
                    <input v-on:keyup="clearSelect" autocomplete="off" class="form-control" v-model="questionRadio" id="questionRadio">
                </div>
                <div class="form-group">
                    <label for="answerRadio">Please write answer</label>
                    <input autocomplete="off" class="form-control" v-model="answerRadio" id="answerTextRadio">
                </div>
                <div class="form-group">
                    <label class="form-check-label d-block" for="answerTrue">
                        Check correct answer
                    </label>
                    <input class="form-check-input" type="checkbox" v-model="answerTrue" id="answerTextTrue">
                </div>
                <div class="form-group">
                    <button @click="addRadioTask()" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- End Radio tasks -->

            <!-- Radio tasks With text-->
            <div id="blockFourth" class="w-75 mt-3 ml-5  border p-3 blocksTasks">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Write reading text</span>
                        </div>
                        <textarea class="form-control" name="text" v-model="readingRadioText" id="readingRadioText" cols="10"
                                  rows="6"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="questionRadio">Please write question</label>
                    <input v-on:keyup="clearSelectText" autocomplete="off" class="form-control" v-model="questionRadioText" id="questionRadioText">
                </div>
                <div class="form-group">
                    <label for="answerRadio">Please write answer</label>
                    <input autocomplete="off" class="form-control" v-model="answerRadioText" id="answerRadio">
                </div>
                <div class="form-group">
                    <label class="form-check-label d-block" for="answerTrue">
                        Check correct answer
                    </label>
                    <input class="form-check-input" type="checkbox" v-model="answerTrueText" id="answerTrue">
                </div>
                <div class="form-group">
                    <button @click="addRadioTextTask()" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- End Radio tasks -->

            <!-- Split tasks -->
            <div id="blockFifth" class="w-75 mt-3 ml-5  border p-3 blocksTasks">
                <div class="form-group">
                    <label for="questionSplit">Please write sentence</label>
                    <input autocomplete="off" class="form-control" v-model="questionSplit" id="questionSplit">
                </div>
                <div class="form-group">
                    <button @click="addSplitTask()" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- End Split tasks -->

            <!-- Catch tasks -->
            <div id="blockSixth" class="w-75 mt-3 ml-5  border p-3 blocksTasks">
                <div class="form-group">
                    <label for="questionCatch">Please write sentence</label>
                    <input autocomplete="off" class="form-control" v-model="questionCatch" id="questionCatch">
                </div>
                <div class="form-group">
                    <label for="questionCatch">Please write missing word</label>
                    <input autocomplete="off" class="form-control" v-model="word" id="word">
                </div>
                <div class="form-group">
                    <button @click="addCatchTask()" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- End Catch tasks -->

            <!-- Two Part tasks -->
            <div id="blockEigth" class="w-75 mt-3 ml-5  border p-3 blocksTasks">
                <div class="form-group">
                    <label for="questionFirst">Please write first part</label>
                    <input autocomplete="off" class="form-control" v-model="questionFirst" id="questionFirst">
                </div>
                <div class="form-group">
                    <label for="questionFirst">Please write second part</label>
                    <input autocomplete="off" class="form-control" v-model="questionSecond" id="questionSecond">
                </div>
                <div class="form-group">
                    <button @click="addPartTask()" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- End Two Part tasks -->
        </div>


        <div class="border mt-3 pt-3 pl-2">
            <h4>tasks</h4>
            <ol v-if="(generalTasks && generalTasks.length > 0)">
                <li class="mt-2" v-for="(generalTask , ind) in generalTasks" :value="generalTask.id">
                    <i @click="editGeneralTask(generalTask.id)" class="fa fa-edit mr-2 cursor-pointer"></i>
                    <i @click="deleteGeneralTask(generalTask.id)" class="fa fa-trash mr-2 cursor-pointer"></i>
                    {{ generalTask.question }}
                </li>
            </ol>
            <ol v-if="(booleanTasks && booleanTasks.length > 0)">
                <li class="mt-2" v-for="(booleanTask , ind) in booleanTasks" :value="booleanTask.id">
                    <i @click="editBooleanTask(booleanTask.id)" class="fa fa-edit mr-2 cursor-pointer"></i>
                    <i @click="deleteBooleanTask(booleanTask.id)" class="fa fa-trash mr-2 cursor-pointer"></i>
                    {{ booleanTask.question }}
                    -
                    <span v-if="booleanTask.answer === 1"> True</span>
                    <span v-if="booleanTask.answer !== 1"> False</span>
                </li>
            </ol>
            <ol v-if="(radioTasksQuestion && radioTasksQuestion.length > 0)">
                <li class="mt-2" v-for="(radioTask , ind) in radioTasksQuestion" :value="radioTask.id">
                    <i @click="editRadioTask(radioTask.id)" class="fa fa-edit mr-2 cursor-pointer"></i>
                    <i @click="deleteRadioTask(radioTask.id)" class="fa fa-trash mr-2 cursor-pointer"></i>
                    {{ radioTask.question }}
                        <ol v-if="(radioTask.answers && radioTask.answers.length > 0)" class="answers">
                            <li class="mt-2 ml-5" v-for="(answer , index) in radioTask.answers" :value="answer.id">
                                <i @click="editRadioTaskAnswer(answer.id)" class="fa fa-edit mr-2 cursor-pointer"></i>
                                <i @click="deleteRadioTaskAnswer(answer.id)" class="fa fa-trash mr-2 cursor-pointer"></i>
                                {{ answer.answer }}
                                -
                                <span v-if="answer.correct === 1"> True</span>
                                <span v-if="answer.correct !== 1"> False</span>
                            </li>
                        </ol>
                </li>
            </ol>
            <ol v-if="(radioTasksTextQuestion && radioTasksTextQuestion.questions && radioTasksTextQuestion.questions.length > 0)">
                <li class="mt-2" v-for="(radioTask , ind) in radioTasksTextQuestion.questions" :value="radioTask.id">
                    <i @click="editRadioTextTask(radioTask.id)" class="fa fa-edit mr-2 cursor-pointer"></i>
                    <i @click="deleteRadioTextTask(radioTask.id)" class="fa fa-trash mr-2 cursor-pointer"></i>
                    {{ radioTask.question }}
                        <ol v-if="(radioTask.answers && radioTask.answers.length > 0)" class="answers">
                            <li class="mt-2 ml-5" v-for="(answer , index) in radioTask.answers" :value="answer.id">
                                <i @click="editRadioTextTaskAnswer(answer.id)" class="fa fa-edit mr-2 cursor-pointer"></i>
                                <i @click="deleteRadioTextTaskAnswer(answer.id)" class="fa fa-trash mr-2 cursor-pointer"></i>
                                {{ answer.answer }}
                                -
                                <span v-if="answer.correct === 1"> True</span>
                                <span v-if="answer.correct !== 1"> False</span>
                            </li>
                        </ol>
                </li>
            </ol>
            <ol v-if="(splitTasks && splitTasks.length > 0)">
                <li class="mt-2" v-for="(splitTask , ind) in splitTasks" :value="splitTask.id">
                    <i @click="editSplitTask(splitTask.id)" class="fa fa-edit mr-2 cursor-pointer"></i>
                    <i @click="deleteSplitTask(splitTask.id)" class="fa fa-trash mr-2 cursor-pointer"></i>
                    {{ splitTask.split_text }}
                    ->
                    <span v-for="(code, ind) in splitTask.words" :key="ind">
                        <span v-if="ind === splitTask.words.length - 1">{{code.word}}</span>
                        <span v-if="ind !== splitTask.words.length - 1">{{code.word}}, </span>
                    </span>
                </li>
            </ol>
            <ol v-if="(catchTasks && catchTasks.length > 0)">
                <li class="mt-2" v-for="(catchTask , ind) in catchTasks" :value="catchTask.id">
                    <i @click="editCatchTask(catchTask.id)" class="fa fa-edit mr-2 cursor-pointer"></i>
                    <i @click="deleteCatchTask(catchTask.id)" class="fa fa-trash mr-2 cursor-pointer"></i>
                    {{ catchTask.catch_text }} -> {{catchTask.word}}
                </li>
            </ol>
            <ol v-if="(towPartTasks && towPartTasks.length > 0)">
                <li class="mt-2" v-for="(partTask , ind) in towPartTasks" :value="partTask.id">
                    <i @click="editTwoPartTask(partTask.id)" class="fa fa-edit mr-2 cursor-pointer"></i>
                    <i @click="deleteTwoPartTask(partTask.id)" class="fa fa-trash mr-2 cursor-pointer"></i>
                    {{ partTask.get_first_part.question }} - {{ partTask.get_second_part.question }}
                </li>
            </ol>
        </div>

        <!-- General tasks modal -->
        <modal name="editGeneralModal" class="editLessonModal showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText">Edit question</h4>
                    <div class="col-12">
                        <input autocomplete="off" v-model="editGeneral" placeholder="Question" class="form-control" id="editGeneral"
                               type="text" required>
                    </div>
                    <input autocomplete="off" type="text" hidden v-model="editId">
                    <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="updateGeneralTask">Update
                    </button>
                </div>
            </div>
        </modal>

        <modal name="deleteGeneral" class="deleteMain showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete task ?</h4>
                    <input autocomplete="off" type="text" hidden v-model="deleteId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deleteGeneralTask">
                            Confirm
                        </button>
                        <button class="ml-3 btn btn-primary mt-3" type="button"
                                @click.prevent="cancelModal('deleteGeneral')">Cancel
                        </button>
                    </div>

                </div>
            </div>
        </modal>
        <!-- End General tasks modal -->

        <!-- Boolean tasks modal -->
        <modal name="editBooleanModal" class="editLessonModal showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText">Edit question</h4>
                    <div class="col-12">
                        <input autocomplete="off" v-model="editBoolean" placeholder="Question" class="form-control" id="editBoolean"
                               type="text" required>
                    </div>
                    <div class="col-12">
                    <select id="editAnswerBoolean" class="custom-select mt-3" v-model="editAnswerBoolean">
                        <option value="1">True</option>
                        <option value="0">False</option>
                    </select>
                        </div>
                    <input autocomplete="off" type="text" hidden v-model="editBooleanId">
                    <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="updateBooleanTask">Update
                    </button>
                </div>
            </div>
        </modal>

        <modal name="deleteBoolean" class="deleteMain showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete task ?</h4>
                    <input autocomplete="off" type="text" hidden v-model="deleteId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deleteBooleanTask">
                            Confirm
                        </button>
                        <button class="ml-3 btn btn-primary mt-3" type="button"
                                @click.prevent="cancelModal('deleteBoolean')">Cancel
                        </button>
                    </div>

                </div>
            </div>
        </modal>
        <!-- End General tasks modal -->

        <!-- Radio tasks modal -->
        <modal name="editRadioModal" class="editLessonModal showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText">Edit question</h4>
                    <div class="col-12">
                        <input autocomplete="off" v-model="editRadioQuestion" placeholder="Question" class="form-control" id="editRadioQuestion"
                               type="text" required>
                    </div>
                    <input autocomplete="off" type="text" hidden v-model="editRadioId">
                    <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="updateRadioTask">Update
                    </button>
                </div>
            </div>
        </modal>

        <modal name="deleteRadio" class="deleteMain showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete task ?</h4>
                    <input autocomplete="off" type="text" hidden v-model="deleteId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deleteRadioTask">
                            Confirm
                        </button>
                        <button class="ml-3 btn btn-primary mt-3" type="button"
                                @click.prevent="cancelModal('deleteRadio')">Cancel
                        </button>
                    </div>

                </div>
            </div>
        </modal>
        <!-- End Radio tasks modal -->

        <!-- Radio tasks Answer modal -->
        <modal name="editRadioModalAnswer" class="editLessonModal showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText">Edit question answer</h4>
                    <div class="col-12">
                        <input autocomplete="off" v-model="editRadioAnswer" placeholder="Question" class="form-control" id="editRadioAnswer"
                               type="text" required>
                    </div>
                    <div class="col-12">
                        <select id="editRadioAnswerCorrect" class="custom-select mt-3" v-model="editRadioAnswerCorrect">
                            <option value="1">True</option>
                            <option value="null">False</option>
                        </select>
                    </div>
                    <input autocomplete="off" type="text" hidden v-model="editRadioAnswerId">
                    <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="updateRadioTaskAnswer">Update
                    </button>
                </div>
            </div>
        </modal>

        <modal name="deleteRadioTaskAnswer" class="deleteMain showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete this answer ?</h4>
                    <input autocomplete="off" type="text" hidden v-model="deleteId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deleteRadioTaskAnswer(deleteId)">
                            Confirm
                        </button>
                        <button class="ml-3 btn btn-primary mt-3" type="button"
                                @click.prevent="cancelModal('deleteRadioTaskAnswer')">Cancel
                        </button>
                    </div>

                </div>
            </div>
        </modal>
        <!-- End Radio tasks Answer modal -->


        <!-- Radio tasks modal -->
        <modal name="editRadioTextModal" class="editLessonModal showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText">Edit question</h4>
                    <div class="col-12">
                        <input autocomplete="off" v-model="editRadioTextQuestion" placeholder="Question" class="form-control" id="editRadioTextQuestion"
                               type="text" required>
                    </div>
                    <input autocomplete="off" type="text" hidden v-model="editRadioTextId">
                    <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="updateRadioTextTask">Update
                    </button>
                </div>
            </div>
        </modal>

        <modal name="deleteRadioText" class="deleteMain showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete task ?</h4>
                    <input autocomplete="off" type="text" hidden v-model="deleteId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deleteRadioTextTask">
                            Confirm
                        </button>
                        <button class="ml-3 btn btn-primary mt-3" type="button"
                                @click.prevent="cancelModal('deleteRadio')">Cancel
                        </button>
                    </div>

                </div>
            </div>
        </modal>
        <!-- End Radio tasks modal -->


        <!-- Radio Text tasks Answer modal -->
        <modal name="editRadioTextModalAnswer" class="editLessonModal showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText">Edit question answer</h4>
                    <div class="col-12">
                        <input autocomplete="off" v-model="editRadioTextAnswer" placeholder="Question" class="form-control" id="editRadioTextAnswer"
                               type="text" required>
                    </div>
                    <div class="col-12">
                        <select id="editRadioTextAnswerCorrect" class="custom-select mt-3" v-model="editRadioTextAnswerCorrect">
                            <option value="1">True</option>
                            <option value="null">False</option>
                        </select>
                    </div>
                    <input autocomplete="off" type="text" hidden v-model="editRadioTextAnswerId">
                    <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="updateRadioTextTaskAnswer">Update
                    </button>
                </div>
            </div>
        </modal>

        <modal name="deleteRadioTextTaskAnswer" class="deleteMain showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete this answer ?</h4>
                    <input autocomplete="off" type="text" hidden v-model="deleteId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deleteRadioTextTaskAnswer(deleteId)">
                            Confirm
                        </button>
                        <button class="ml-3 btn btn-primary mt-3" type="button"
                                @click.prevent="cancelModal('deleteRadioTaskAnswer')">Cancel
                        </button>
                    </div>

                </div>
            </div>
        </modal>
        <!-- End Text Radio tasks Answer modal -->
        <!-- Split tasks modal -->
        <modal name="editSplitModal" class="editLessonModal showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText">Edit sentence</h4>
                    <div class="col-12">
                        <input autocomplete="off" v-model="editSplit" placeholder="Question" class="form-control" id="editSplit"
                               type="text" required>
                    </div>
                    <input autocomplete="off" type="text" hidden v-model="editId">
                    <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="updateSplitTask">Update
                    </button>
                </div>
            </div>
        </modal>

        <modal name="deleteSplit" class="deleteMain showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete task ?</h4>
                    <input autocomplete="off" type="text" hidden v-model="deleteId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deleteSplitTask">
                            Confirm
                        </button>
                        <button class="ml-3 btn btn-primary mt-3" type="button"
                                @click.prevent="cancelModal('deleteSplit')">Cancel
                        </button>
                    </div>

                </div>
            </div>
        </modal>
        <!-- End Split tasks modal -->

        <!-- Catch tasks modal -->
        <modal name="editCatchModal" class="editLessonModal showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText">Edit sentence</h4>
                    <div class="col-12">
                        <input autocomplete="off" v-model="editCatch" placeholder="Question" class="form-control" id="editCatch"
                               type="text" required>
                    </div>
                    <div class="col-12 mt-4">
                        <input autocomplete="off" v-model="editWord" placeholder="word" class="form-control" id="editWord"
                               type="text" required>
                    </div>
                    <input autocomplete="off" type="text" hidden v-model="editId">
                    <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="updateCatchTask">Update
                    </button>
                </div>
            </div>
        </modal>

        <modal name="deleteCatch" class="deleteMain showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete task ?</h4>
                    <input autocomplete="off" type="text" hidden v-model="deleteId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deleteCatchTask">
                            Confirm
                        </button>
                        <button class="ml-3 btn btn-primary mt-3" type="button"
                                @click.prevent="cancelModal('deleteCatch')">Cancel
                        </button>
                    </div>

                </div>
            </div>
        </modal>
        <!-- End Catch tasks modal -->

        <!-- Two Part tasks modal -->
        <modal name="editTwoPartModal" class="editLessonModal showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 pl-5 pr-5">
                <div class="form-group">
                    <h4 class="ml-3 mb-2 orangeText">Please write first part</h4>
                    <div class="col-12">
                        <label for="editQuestionFirst">Phrase</label>
                        <input autocomplete="off" v-model="editQuestionFirst" placeholder="Question" class="form-control" id="editQuestionFirst"
                               type="text" required>
                    </div>
                    <div class="col-12 mt-2">
                        <label for="editQuestionSecond">Please write second part</label>
                        <input autocomplete="off" v-model="editQuestionSecond" placeholder="Correct" class="form-control" id="editQuestionSecond"
                               type="text" required>
                    </div>
                    <input autocomplete="off" type="text" hidden v-model="editId">
                    <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="updatepartTask">Update
                    </button>
                </div>
            </div>
        </modal>

        <modal name="deleteTwoPart" class="deleteMain showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete task ?</h4>
                    <input autocomplete="off" type="text" hidden v-model="deleteId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deleteTwoPartTask">
                            Confirm
                        </button>
                        <button class="ml-3 btn btn-primary mt-3" type="button"
                                @click.prevent="cancelModal('deleteTwoPart')">Cancel
                        </button>
                    </div>

                </div>
            </div>
        </modal>
        <!-- End Two Part  tasks modal -->

    </div>
</template>

<script>
import API from "../../../api";

export default {
    name: "LessonSlideContent",
    data() {
        return {
            lessonSlideId: null,
            lessonSlide: null,
            taskTypes: null,
            typeId: null,
            readingBoolean: null,
            questionBoolean: null,
            answerBoolean: null,
            questionGeneral: null,
            generalTasks: null,
            deleteId: null,
            url: null,
            booleanTasks: null,
            readingGeneral: null,
            editGeneral: null,
            editId: null,
            editBooleanId: null,
            editBoolean: null,
            editAnswerBoolean: null,
            questionRadio: null,
            questionRadioText: null,
            answerRadio: null,
            answerRadioText: null,
            answerTrue: null,
            answerTrueText: null,
            radioTasksQuestion: null,
            choosenQuestion: null,
            choosenTextQuestion: null,
            editRadioQuestion: null,
            editRadioTextQuestion: null,
            editRadioId: null,
            editRadioAnswer: null,
            editRadioAnswerId: null,
            editRadioAnswerCorrect: null,
            editRadioQuestionId: null,
            questionTextRadio: null,
            answerTextRadio: null,
            answerTextTrue: null,
            radioTasksTextQuestion: null,
            readingRadioText: null,
            editRadioTextId: null,
            editRadioTextAnswer: null,
            editRadioTextAnswerCorrect: null,
            editRadioTextAnswerId: null,
            editRadioTextQuestionId: null,
            chooseTextQuestion: null,
            questionSplit: null,
            splitTasks: null,
            editSplit: null,
            questionCatch: null,
            catchTasks: null,
            editCatch: null,
            word: null,
            editWord: null,
            towPartTasks: null,
            editQuestionFirst: null,
            editQuestionSecond: null,
            questionFirst: null,
            questionSecond: null,
        }
    },
    methods: {
        getLessonHomework() {
            this.lessonSlideId = parseInt(this.$route.params.id)
            API.post("/api/dashboard/lesson-slide", {id: this.lessonSlideId})
                .then(res => {
                    this.lessonSlide = res.data.lessonSlide
                })
                .catch(err => {
                    console.log(err)
                })
        },
        getTaskTypes() {
            API.post('/api/dashboard/tasks-types')
                .then(res => {
                    this.taskTypes = res.data
                }).catch(err => {
                console.log(err)
            })
        },
        chooseType() {
            document.querySelector("#blockFirst").style.display = "none";
            document.querySelector("#blockSecond").style.display = "none";
            document.querySelector("#blockThird").style.display = "none";
            document.querySelector("#blockFourth").style.display = "none";
            document.querySelector("#blockFifth").style.display = "none";
            document.querySelector("#blockSixth").style.display = "none";
            document.querySelector("#blockEigth").style.display = "none";
            this.booleanTasks = null
            this.generalTasks = null
            this.radioTasksQuestion = null
            this.radioTasksTextQuestion = null
            this.splitTasks = null
            this.catchTasks = null
            this.towPartTasks = null
            if (this.typeId == 2) {
                document.querySelector("#blockSecond").style.display = "block";
                API.post('/api/dashboard/general-task', {lessonSlideId: this.lessonSlideId})
                    .then(res => {
                        this.generalTasks = res.data.questions
                        this.readingGeneral = res.data.reading
                    }).catch(err => {
                    console.log(err)
                })
            } else if (this.typeId == 1) {
                document.querySelector("#blockFirst").style.display = "block";
                API.post('/api/dashboard/boolean-task', {lessonSlideId: this.lessonSlideId})
                    .then(res => {
                        this.booleanTasks = res.data.questions
                        this.readingBoolean = res.data.reading
                    }).catch(err => {
                    console.log(err)
                })
            }else if (this.typeId == 3) {
                document.querySelector("#blockThird").style.display = "block";
                API.post('/api/dashboard/radio-task', {lessonSlideId: this.lessonSlideId})
                    .then(res => {
                        this.radioTasksQuestion = res.data
                    }).catch(err => {
                    console.log(err)
                })
            }else if (this.typeId == 4) {
                document.querySelector("#blockFourth").style.display = "block";
                API.post('/api/dashboard/radio-text-task', {lessonSlideId: this.lessonSlideId})
                    .then(res => {
                        this.radioTasksTextQuestion = res.data
                        this.readingRadioText = res.data.radio_text
                    }).catch(err => {
                    console.log(err)
                })
            }else if (this.typeId === 5) {
                document.querySelector("#blockFifth").style.display = "block";

                API.post('/api/dashboard/split-tasks', {lessonSlideId: this.lessonSlideId})
                    .then(res => {
                        this.splitTasks = res.data
                        console.log(res.data)
                    }).catch(err => {
                    console.log(err)
                })
            }else if (this.typeId === 6) {
                document.querySelector("#blockSixth").style.display = "block";

                API.post('/api/dashboard/catch-tasks', {lessonSlideId: this.lessonSlideId})
                    .then(res => {
                        this.catchTasks = res.data
                        console.log(res.data)
                    }).catch(err => {
                    console.log(err)
                })
            }else if(this.typeId === 7){

            }else if (this.typeId === 8) {
                document.querySelector("#blockEigth").style.display = "block";

                API.post('/api/dashboard/two-part-tasks', {lessonSlideId: this.lessonSlideId})
                    .then(res => {
                        this.towPartTasks = res.data
                        console.log(res.data)
                    }).catch(err => {
                    console.log(err)
                })
            }
        },
        addGeneralTask() {

            if(!this.questionGeneral && !this.readingGeneral){
                this.showErrorMsg()
                return false
            }
            API.post('/api/dashboard/add-general-task', {
                questionGeneral: this.questionGeneral,
                lessonSlideId: this.lessonSlideId,
                readingGeneral: this.readingGeneral,
                id: this.editId
            })
                .then(res => {
                    this.editId = null
                    this.deleteId = null
                    this.questionGeneral = ""
                    this.showSuccessMsg()
                    this.generalTasks = res.data.questions
                }).catch(err => {
                console.log(err)
            })
        },
        editGeneralTask(id) {
            API.post('/api/dashboard/edit-general-task', {id: id})
                .then(res => {
                    this.editGeneral = res.data.question
                    this.editId = res.data.id
                    this.showModal("editGeneralModal")
                    this.showInfoMsg()
                }).catch(err => {
                console.log(err)
            })
        },
        updateGeneralTask(id) {
            API.post('/api/dashboard/update-general-task', {
                id: this.editId,
                readingGeneral: this.readingGeneral,
                questionGeneral: this.editGeneral,
                lessonSlideId: this.lessonSlideId,
            })
                .then(res => {
                    this.editId = null
                    this.editGeneral = null
                    this.questionGeneral = res.data.question
                    this.generalTasks = res.data.questions
                    this.readingGeneral = res.data.reading
                    this.cancelModal("editGeneralModal")
                    this.showSuccessMsg()
                }).catch(err => {
                console.log(err)
            })
        },
        deleteGeneralTask(id) {
            if (this.deleteId) {
                API.post('/api/dashboard/delete-general-task', {id: this.deleteId, lessonSlideId: this.lessonSlideId})
                    .then(res => {
                        this.editId = null
                        this.deleteId = null
                        this.questionGeneral = ""
                        this.cancelModal("deleteGeneral")
                        this.showSuccessMsg()
                        this.generalTasks = res.data.questions
                        this.booleanTasks = null
                    }).catch(err => {
                    console.log(err)
                })
            } else {
                this.deleteModal(id, "deleteGeneral")
            }
        },
        addBooleanTask(){
            if(!this.questionBoolean && !this.readingBoolean){
                this.showErrorMsg()
                return false
            }
            API.post("/api/dashboard/add-boolean-task", {
                readingBoolean: this.readingBoolean,
                questionBoolean: this.questionBoolean,
                answerBoolean: this.answerBoolean,
                lessonSlideId: this.lessonSlideId
            })
                .then(res => {
                    this.showSuccessMsg()
                    this.booleanTasks = res.data.questions
                    this.questionBoolean = ""
                    this.answerBoolean = null
                }).catch(err => {
                console.log(err)
            })
        },
        editBooleanTask(id) {
            API.post('/api/dashboard/edit-boolean-task', {id: id})
                .then(res => {
                    this.editBoolean = res.data.question
                    this.editBooleanId = res.data.id
                    this.editAnswerBoolean = res.data.answer
                    this.editId = res.data.id
                    this.showModal("editBooleanModal")
                    this.showInfoMsg()
                }).catch(err => {
                console.log(err)
            })
        },
        updateBooleanTask() {
            API.post('/api/dashboard/update-boolean-task', {
                id: this.editId,
                readingBoolean: this.readingBoolean,
                questionBoolean: this.editBoolean,
                lessonSlideId: this.lessonSlideId,
                answerBoolean: this.editAnswerBoolean,
            })
                .then(res => {
                    this.editId = null
                    this.booleanTasks = res.data.questions
                    this.readingBoolean = res.data.reading
                    this.cancelModal("editBooleanModal")
                    this.showSuccessMsg()
                }).catch(err => {
                console.log(err)
            })
        },
        deleteBooleanTask(id) {
            if (this.deleteId) {
                API.post('/api/dashboard/delete-boolean-task', {id: this.deleteId, lessonSlideId: this.lessonSlideId})
                    .then(res => {
                        this.editId = null
                        this.deleteId = null
                        this.generalTasks = null
                        this.questionGeneral = ""
                        this.cancelModal("deleteBoolean")
                        this.showSuccessMsg()
                        this.booleanTasks = res.data.questions
                        this.generalTasks = null
                    }).catch(err => {
                    console.log(err)
                })
            } else {
                this.deleteModal(id, "deleteGeneral")
            }
        },
        addRadioTask(){
            if(!this.answerRadio && !this.answerRadio){
                this.showErrorMsg()
                return false
            }
            API.post("/api/dashboard/add-radio-task", {
                question: this.questionRadio,
                answer: this.answerRadio,
                correct: this.answerTrue,
                lessonSlideId: this.lessonSlideId,
                choosenQuestion: this.choosenQuestion,
            })
                .then(res => {
                    if(res.data == 0){
                        this.showErrorMsg()
                    }else{
                        this.showSuccessMsg()
                        this.radioTasksQuestion = res.data
                        this.questionBoolean = ""
                        this.answerBoolean = null
                    }

                }).catch(err => {
                console.log(err)
            })
        },
        editRadioTask(id){
            API.post('/api/dashboard/edit-radio-task', {id: id})
                .then(res => {
                    this.editRadioQuestion = res.data.question
                    this.editRadioId = res.data.id
                    this.editId = res.data.id
                    this.showModal("editRadioModal")
                    this.showInfoMsg()
                }).catch(err => {
                console.log(err)
            })
        },
        updateRadioTask() {
            API.post('/api/dashboard/update-radio-task', {
                id: this.editId,
                lessonSlideId: this.lessonSlideId,
                question: this.editRadioQuestion,
            })
                .then(res => {
                    this.editId = null
                    this.radioTasksQuestion = res.data
                    this.cancelModal("editRadioModal")
                    this.showSuccessMsg()
                }).catch(err => {
                console.log(err)
            })
        },
        deleteRadioTask(id){
            if(this.deleteId){
                API.post("/api/dashboard/delete-radio-task", {
                    id: this.deleteId,
                    lessonSlideId: this.lessonSlideId
                })
                    .then(res => {
                        this.generalTasks = null
                        this.editId = null
                        this.deleteId = null
                        this.generalTasks = null
                        this.booleanTasks = null
                        this.answerTrue = null
                        this.answerRadio = ""
                        this.cancelModal("deleteRadio")
                        this.showSuccessMsg()
                        this.radioTasksQuestion = res.data
                    }).catch(err => {
                    console.log(err)
                })
            }else{
                this.deleteModal(id, "deleteRadio")
            }
        },
        editRadioTaskAnswer(id){
            API.post('/api/dashboard/edit-radio-task-answer', {id: id})
                .then(res => {
                    this.editRadioAnswer = res.data.answer
                    this.editRadioQuestionId = res.data.radio_task_id
                    this.editRadioAnswerCorrect = res.data.correct
                    this.editRadioAnswerId = res.data.id
                    this.editId = res.data.id
                    this.showModal("editRadioModalAnswer")
                    this.showInfoMsg()
                }).catch(err => {
                console.log(err)
            })
        },
        updateRadioTaskAnswer() {
            API.post('/api/dashboard/update-radio-task-answer', {
                id: this.editId,
                lessonSlideId: this.lessonSlideId,
                answer: this.editRadioAnswer,
                correct: this.editRadioAnswerCorrect,
                radioTaskId: this.editRadioQuestionId,
            })
                .then(res => {
                    if(res.data == 0){
                        this.showErrorMsg()
                    }else{
                        this.editId = null
                        this.editRadioAnswer = null
                        this.editRadioAnswerCorrect = null
                        this.editRadioQuestionId = null
                        this.radioTasksQuestion = res.data
                        this.cancelModal("editRadioModalAnswer")
                        this.showSuccessMsg()
                    }
                }).catch(err => {
                console.log(err)
            })
        },
        deleteRadioTaskAnswer(id){
            if(this.deleteId){
                API.post("/api/dashboard/delete-radio-task-answer", {
                    id: this.deleteId,
                    lessonSlideId: this.lessonSlideId
                })
                    .then(res => {
                        if(res.data == 0){
                            this.showErrorMsg()
                        }else{
                            this.editId = null
                            this.deleteId = null
                            this.generalTasks = null
                            this.booleanTasks = null
                            this.answerTrue = null
                            this.answerRadio = null
                            this.cancelModal("deleteRadioTaskAnswer")
                            this.showSuccessMsg()
                            this.radioTasksQuestion = res.data
                        }

                    }).catch(err => {
                    console.log(err)
                })
            }else{
                this.deleteModal(id, "deleteRadioTaskAnswer")
            }
        },
        addRadioTextTask(){

            API.post("/api/dashboard/add-radio-text-task", {
                readingText: this.readingRadioText,
                question: this.questionRadioText,
                answer: this.answerRadioText,
                correct: this.answerTrueText,
                lessonSlideId: this.lessonSlideId,
                choosenTextQuestion: this.choosenTextQuestion,
            })
                .then(res => {
                    if(res.data == 0){
                        this.showErrorMsg()
                    }else{
                        this.showSuccessMsg()
                        this.radioTasksTextQuestion = res.data
                        this.questionRadioText = null
                        this.answerRadioText = null
                        this.answerTrueText = null
                    }

                }).catch(err => {
                console.log(err)
            })
        },
        editRadioTextTask(id){
            API.post('/api/dashboard/edit-radio-text-task', {id: id})
                .then(res => {
                    if(res.data === 0){
                        this.showErrorMsg()
                    }else{
                        this.editRadioTextQuestion = res.data.question
                        this.editRadioTextId = res.data.id
                        this.editId = res.data.id
                        this.showModal("editRadioTextModal")
                        this.showInfoMsg()
                    }
                }).catch(err => {
                console.log(err)
            })
        },
        updateRadioTextTask() {
            API.post('/api/dashboard/update-radio-text-task', {
                id: this.editRadioTextId,
                lessonSlideId: this.lessonSlideId,
                question: this.editRadioTextQuestion,
            }).then(res => {
                    if(res.data === 0){
                        this.showErrorMsg()
                    }else{
                        this.editId = null
                        this.editRadioTextId = null
                        this.editRadioTextQuestion = null
                        this.radioTasksTextQuestion = res.data
                        this.cancelModal("editRadioTextModal")
                        this.showSuccessMsg()
                    }
            }).catch(err => {
                console.log(err)
            })
        },
        deleteRadioTextTask(id){
            if(this.deleteId){
                API.post("/api/dashboard/delete-radio-text-task", {
                    id: this.deleteId,
                    lessonSlideId: this.lessonSlideId
                })
                    .then(res => {
                        if(res.data === 0){
                            this.showErrorMsg()
                        }else{
                            this.generalTasks = null
                            this.editId = null
                            this.deleteId = null
                            this.generalTasks = null
                            this.booleanTasks = null
                            this.answerTextTrue = null
                            this.answerTextRadio = null
                            this.cancelModal("deleteRadioText")
                            this.showSuccessMsg()
                            this.radioTasksTextQuestion = res.data
                        }
                    }).catch(err => {
                    console.log(err)
                })
            }else{
                this.deleteModal(id, "deleteRadioText")
            }
        },
        editRadioTextTaskAnswer(id){
            API.post('/api/dashboard/edit-radio-text-task-answer', {id: id})
                .then(res => {
                    this.editRadioTextAnswer = res.data.answer
                    this.editRadioTextAnswerCorrect = res.data.correct
                    this.editRadioTextAnswerId = res.data.id
                    this.editId = res.data.id
                    this.showModal("editRadioTextModalAnswer")
                    this.showInfoMsg()
                }).catch(err => {
                console.log(err)
            })
        },
        updateRadioTextTaskAnswer() {
            API.post('/api/dashboard/update-radio-text-task-answer', {
                id: this.editId,
                lessonSlideId: this.lessonSlideId,
                answer: this.editRadioTextAnswer,
                correct: this.editRadioTextAnswerCorrect,
                radioTaskId: this.editRadioTextQuestionId,
            })
                .then(res => {
                    if(res.data == 0){
                        this.showErrorMsg()
                    }else{
                        this.radioTasksTextQuestion = res.data
                        this.cancelModal("editRadioTextModalAnswer")
                        this.showSuccessMsg()
                    }
                }).catch(err => {
                console.log(err)
            })
        },
        deleteRadioTextTaskAnswer(id){
            if(this.deleteId){
                API.post("/api/dashboard/delete-radio-text-task-answer", {
                    id: this.deleteId,
                    lessonSlideId: this.lessonSlideId
                })
                    .then(res => {
                        if(res.data == 0){
                            this.showErrorMsg()
                        }else{
                            console.log(res.data)
                            this.editId = null
                            this.deleteId = null
                            this.cancelModal("deleteRadioTextTaskAnswer")
                            this.showSuccessMsg()
                            this.radioTasksTextQuestion = res.data
                        }

                    }).catch(err => {
                    console.log(err)
                })
            }else{
                this.deleteModal(id, "deleteRadioTextTaskAnswer")
            }
        },

        addSplitTask() {
            if(!this.questionSplit){
                this.showErrorMsg()
                return false
            }
            API.post('/api/dashboard/add-split-task', {
                questionSplit: this.questionSplit,
                lessonSlideId: this.lessonSlideId,
            })
                .then(res => {
                    if(res.data === 0){
                        this.showErrorMsg()
                    }else{
                        this.editId = null
                        this.deleteId = null
                        this.questionSplit = null
                        this.showSuccessMsg()
                        this.splitTasks = res.data
                    }
                }).catch(err => {
                console.log(err)
            })
        },
        editSplitTask(id) {
            API.post('/api/dashboard/edit-split-task', {id: id})
                .then(res => {
                    if(res.data === 0){
                        this.showErrorMsg()
                    }else{
                        this.editSplit = res.data.split_text
                        this.editId = res.data.id
                        this.showModal("editSplitModal")
                        this.showInfoMsg()
                    }
                }).catch(err => {
                console.log(err)
            })
        },
        updateSplitTask(id) {
            API.post('/api/dashboard/update-split-task', {
                id: this.editId,
                editSplit: this.editSplit,
                lessonSlideId: this.lessonSlideId,
            })
                .then(res => {
                    if(res.data === 0){
                        this.showErrorMsg()
                    }else {
                        this.editId = null
                        this.editSplit = null
                        this.splitTasks = res.data
                        this.cancelModal("editSplitModal")
                        this.showSuccessMsg()
                    }
                }).catch(err => {
                console.log(err)
            })
        },
        deleteSplitTask(id) {
            if (this.deleteId) {
                API.post('/api/dashboard/delete-split-task', {id: this.deleteId, lessonSlideId: this.lessonSlideId})
                    .then(res => {
                        if(res.data === 0){
                            this.showErrorMsg()
                        }else {
                            this.editId = null
                            this.deleteId = null
                            this.cancelModal("deleteSplit")
                            this.showSuccessMsg()
                            this.splitTasks = res.data
                        }
                    }).catch(err => {
                    console.log(err)
                })
            } else {
                this.deleteModal(id, "deleteSplit")
            }
        },
        addCatchTask() {
            if(!this.questionCatch){
                this.showErrorMsg()
                return false
            }
            API.post('/api/dashboard/add-catch-task', {
                questionCatch: this.questionCatch,
                lessonSlideId: this.lessonSlideId,
                word: this.word,
            })
                .then(res => {
                    if(res.data === 0){
                        this.showErrorMsg()
                    }else{
                        this.editId = null
                        this.deleteId = null
                        this.questionCatch = null
                        this.word = null
                        this.showSuccessMsg()
                        this.catchTasks = res.data
                    }
                }).catch(err => {
                console.log(err)
            })

        },
        editCatchTask(id) {
            API.post('/api/dashboard/edit-catch-task', {id: id})
                .then(res => {
                    if(res.data === 0){
                        this.showErrorMsg()
                    }else{
                        if(res.data === 0){
                            this.showErrorMsg()
                        }else {
                            this.editCatch = res.data.catch_text
                            this.editId = res.data.id
                            this.editWord = res.data.word
                            this.showModal("editCatchModal")
                            this.showInfoMsg()
                        }
                    }
                }).catch(err => {
                console.log(err)
            })
        },
        updateCatchTask(id) {
            API.post('/api/dashboard/update-catch-task', {
                id: this.editId,
                editCatch: this.editCatch,
                editWord: this.editWord,
                lessonSlideId: this.lessonSlideId,
            })
                .then(res => {
                    if(res.data === 0){
                        this.showErrorMsg()
                    }else {
                        this.editId = null
                        this.editCatch = null
                        this.catchTasks = res.data
                        this.cancelModal("editCatchModal")
                        this.showSuccessMsg()
                    }
                }).catch(err => {
                console.log(err)
            })
        },
        deleteCatchTask(id) {
            if (this.deleteId) {
                API.post('/api/dashboard/delete-catch-task', {id: this.deleteId, lessonSlideId: this.lessonSlideId})
                    .then(res => {
                        if(res.data === 0){
                            this.showErrorMsg()
                        }else {
                            this.editId = null
                            this.deleteId = null
                            this.cancelModal("deleteCatch")
                            this.showSuccessMsg()
                            this.catchTasks = res.data
                        }
                    }).catch(err => {
                    console.log(err)
                })
            } else {
                this.deleteModal(id, "deleteCatch")
            }
        },
        addPartTask() {
            if(!this.questionFirst || !this.questionSecond){
                this.showErrorMsg()
                return false
            }
            API.post('/api/dashboard/add-two-part-task', {
                questionFirst: this.questionFirst,
                questionSecond: this.questionSecond,
                lessonSlideId: this.lessonSlideId,
            })
                .then(res => {
                    if(res.data === 0){
                        this.showErrorMsg()
                    }else{
                        this.editId = null
                        this.deleteId = null
                        this.questionFirst = null
                        this.questionSecond = null
                        this.showSuccessMsg()
                        this.towPartTasks = res.data
                    }
                }).catch(err => {
                console.log(err)
            })

        },
        editTwoPartTask(id) {
            API.post('/api/dashboard/edit-two-part-task', {id: id})
                .then(res => {
                    if(res.data === 0){
                        this.showErrorMsg()
                    }else{
                        this.editQuestionFirst = res.data.get_first_part.question
                        this.editQuestionSecond = res.data.get_second_part.question
                        this.editId = res.data.id
                        this.showModal("editTwoPartModal")
                        this.showInfoMsg()
                    }
                }).catch(err => {
                console.log(err)
            })
        },
        updatepartTask(id) {
            API.post('/api/dashboard/update-two-part-task', {
                id: this.editId,
                editQuestionFirst: this.editQuestionFirst,
                editQuestionSecond: this.editQuestionSecond,
                lessonSlideId: this.lessonSlideId,
            })
                .then(res => {
                    if(res.data === 0){
                        this.showErrorMsg()
                    }else {
                        this.editId = null
                        this.editQuestionFirst = null
                        this.editQuestionSecond = null
                        this.towPartTasks = res.data
                        this.cancelModal("editTwoPartModal")
                        this.showSuccessMsg()
                    }
                }).catch(err => {
                console.log(err)
            })
        },
        deleteTwoPartTask(id) {
            if (this.deleteId) {
                API.post('/api/dashboard/delete-two-part-task', {id: this.deleteId, lessonSlideId: this.lessonSlideId})
                    .then(res => {
                        if(res.data === 0){
                            this.showErrorMsg()
                        }else {
                            this.editId = null
                            this.deleteId = null
                            this.cancelModal("deleteTwoPart")
                            this.showSuccessMsg()
                            this.towPartTasks = res.data
                        }
                    }).catch(err => {
                    console.log(err)
                })
            } else {
                this.deleteModal(id, "deleteTwoPart")
            }

        },

        chooseQuestion(){
            this.questionRadio = ""
        },
        chooseQuestionText(){
             this.questionRadioText = null
        },
        clearSelect(){
            if(this.choosenQuestion > 0){
                this.choosenQuestion = null
            }
        },
        clearSelectText(){
            if(this.choosenTextQuestion > 0){
                this.choosenTextQuestion = null
            }
        }
    },
    mounted() {
        this.getLessonHomework()
        this.getTaskTypes()
    }
}
</script>

<style scoped>
#blockFirst, #blockSecond,#blockThird, #blockFourth, #blockFifth, #blockSixth, #blockEigth {
    display: none;
}

ol {
    list-style-type: unset;
}

ol li {
    display: block;
}

input[type=checkbox]:focus{
    border:none;
    outline:none;
    box-shadow:none;
}
.form-check-input{
    position: relative;
    margin-top: 0.3rem;
    margin-left: 0;
    padding: 42px!important;
    width: 22px;
    height: 22px;
}

.answers{
    list-style-type: lower-alpha;
}

</style>
