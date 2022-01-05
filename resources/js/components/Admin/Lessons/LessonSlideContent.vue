<template>
    <div class="w-100 d-inline-block content-dashboard">
        <h4 v-if="lessonSlide">Slide - {{ lessonSlide.slide_name.slide }}</h4>
        <div class="d-flex">
            <div class="w-25 mt-3 border p-3">
                <select class="custom-select" v-model="typeId" @change="chooseType" name="types" id="types">
                    <option :value="null"> Choose task type</option>
                    <option v-for="(type , ind) in taskTypes" :value="type.id">{{ type.type }}</option>
                </select>
            </div>
            <!-- Boolean tasks -->
            <div id="blockFirst" class="w-75 mt-3 ml-5  border p-3 blocksTasks">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Write reading text</span>
                        </div>
                        <textarea class="form-control" name="text" v-model="reading" id="text" cols="10"
                                  rows="6"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="question">Please write question</label>
                    <input class="form-control" name="question" v-model="quest" id="question">
                </div>
                <div class="form-group">
                    <label for="answerBoolean">Correct Answer</label>
                    <select id="answerBoolean" class="custom-select" v-model="answerBoolean">
                        <option value="1">True</option>
                        <option value="0">False</option>
                    </select>
                </div>
                <div class="form-group">
                    <button @click="addBooleanTask" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- General tasks -->
            <div id="blockSecond" class="w-75 mt-3 ml-5  border p-3 blocksTasks">
                <div class="form-group">
                    <label for="question">Please write question</label>
                    <input class="form-control" name="question" v-model="questionGeneral" id="questionGeneral">
                </div>
                <div class="form-group">
                    <button @click="addGeneralTask" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>


        <div class="border mt-3 pt-3 pl-2">
            <h4>tasks</h4>
            <ol v-if="(generalTasks && generalTasks.length > 0)">
                <li class="mt-2" v-for="(generalTask , ind) in generalTasks" :value="generalTask.id">
                    <i @click="editGeneralTask(generalTask.id)" class="fa fa-edit mr-2 cursor-pointer"></i>
                    <i @click="deleteGeneralTask(generalTask.id)" class="fa fa-trash mr-2 cursor-pointer"></i>
                    {{ generalTask.quest }}
                </li>
            </ol>
        </div>

        <modal name="deleteGeneral" class="deleteMain showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group">
                    <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete task ?</h4>
                    <input type="text" hidden v-model="deleteId">
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
            reading: null,
            quest: null,
            answerBoolean: null,
            questionGeneral: null,
            generalTasks: null,
            editId: null,
            deleteId: null,
            url: null,
            booleanTasks: null,
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

            if (this.typeId == 1) {
                this.generalTasks = null
                document.querySelector("#blockFirst").style.display = "block";
            } else if (this.typeId == 2) {
                this.booleanTasks = null
                document.querySelector("#blockSecond").style.display = "block";
                API.post('/api/dashboard/general-task', {lessonSlideId: this.lessonSlideId})
                    .then(res => {
                        this.generalTasks = res.data.generalTasks
                    }).catch(err => {
                    console.log(err)
                })
            }

        },
        addGeneralTask() {
            if (this.editId) {
                this.url = "/api/dashboard/add-general-task";
            } else {
                this.url = "/api/dashboard/update-general-task";
            }

            if(!this.questionGeneral){
                this.showErrorMsg()
                return false
            }
            API.post(this.url, {
                questionGeneral: this.questionGeneral,
                lessonSlideId: this.lessonSlideId,
                id: this.editId
            })
                .then(res => {
                    this.editId = null
                    this.deleteId = null
                    this.questionGeneral = ""
                    this.showSuccessMsg()
                    this.generalTasks = res.data.generalTasks
                }).catch(err => {
                console.log(err)
            })

        },
        editGeneralTask(id) {
            API.post('/api/dashboard/edit-general-task', {id: id})
                .then(res => {
                    this.questionGeneral = res.data.quest
                    this.editId = res.data.id
                    this.showInfoMsg()
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
                        this.generalTasks = res.data.generalTasks
                    }).catch(err => {
                    console.log(err)
                })
            } else {
                this.deleteModal(id, "deleteGeneral")
            }

        },
        addBooleanTask(){
            API.post('/api/dashboard/add-boolean-task', {reading: this.reading, quest: this.quest, answer: this.answerBoolean})
                .then(res => {
                    this.editId = null
                    this.deleteId = null
                    this.questionGeneral = ""
                    this.cancelModal("deleteGeneral")
                    this.showSuccessMsg()
                    this.generalTasks = res.data.generalTasks
                }).catch(err => {
                console.log(err)
            })
        }
    },
    mounted() {
        this.getLessonHomework()
        this.getTaskTypes()
    }
}
</script>

<style scoped>
#blockFirst, #blockSecond {
    display: none;
}

ol {
    list-style-type: unset;
}

ol li {
    display: block;
}
</style>
