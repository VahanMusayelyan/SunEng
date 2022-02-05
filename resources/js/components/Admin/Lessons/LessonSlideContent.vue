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
                    <input autocomplete="off" class="form-control" v-model="answerRadio" id="answerRadio">
                </div>
                <div class="form-group">
                    <label class="form-check-label d-block" for="answerTrue">
                        Check correct answer
                    </label>
                    <input class="form-check-input" type="checkbox" v-model="answerTrue" id="answerTrue">
                </div>
                <div class="form-group">
                    <button @click="addRadioTask()" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- End Radio tasks -->
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
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deleteGeneralTask">
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
            answerRadio: null,
            answerTrue: null,
            radioTasksQuestion: null,
            choosenQuestion: null,
            editRadioQuestion: null,
            editRadioId: null,
            editRadioAnswer: null,
            editRadioAnswerId: null,
            editRadioAnswerCorrect: null,
            editRadioQuestionId: null,
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
            this.booleanTasks = null
            this.generalTasks = null
            this.radioTasksQuestion = null
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
                    console.log(res.data)
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
                    console.log(res.data)
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


        chooseQuestion(){
            this.questionRadio = ""
        },
        clearSelect(){
            if(this.choosenQuestion > 0){
                this.choosenQuestion = null
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
#blockFirst, #blockSecond,#blockThird {
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
