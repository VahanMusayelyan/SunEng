<template>
    <div class="w-100 d-inline-block content-dashboard">
        <h4 v-if="lessonSlide">Slide - {{ lessonSlide.slide_name.slide }}</h4>
        <div class="d-flex">
            <div class="w-25 mt-3 border p-3">
                <select class="custom-select" v-model="typeId" @change="chooseType" name="types" id="types">
                    <option :value="null"> Choose task type</option>
                    <option v-for="(type , ind) in taskTypes" :value="type.id">{{ type.id }} {{ type.type }}</option>
                </select>
            </div>

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
        </div>


        <div class="border mt-3 pt-3 pl-2">
            <h4>tasks</h4>
            <ol v-if="(catchTasks && catchTasks.length > 0)">
                <li class="mt-2" v-for="(catchTask , ind) in catchTasks" :value="catchTask.id">
                    <i @click="editCatchTask(catchTask.id)" class="fa fa-edit mr-2 cursor-pointer"></i>
                    <i @click="deleteCatchTask(catchTask.id)" class="fa fa-trash mr-2 cursor-pointer"></i>
                    {{ catchTask.catch_text }} -> {{catchTask.word}}
                </li>
            </ol>
        </div>

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


    </div>
</template>

<script>
import API from "../../../api";

export default {
    name: "LessonSlideContentSecond",
    data() {
        return {
            lessonSlideId: null,
            lessonSlide: null,
            taskTypes: null,
            typeId: null,
            deleteId: null,
            editId: null,
            questionCatch: null,
            catchTasks: null,
            editCatch: null,
            word: null,
            editWord: null,
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

            document.querySelector("#blockSixth").style.display = "none";


            this.catchTasks = null

            if (this.typeId === 6) {
                document.querySelector("#blockSixth").style.display = "block";

                API.post('/api/dashboard/catch-tasks', {lessonSlideId: this.lessonSlideId})
                    .then(res => {
                        this.catchTasks = res.data
                        console.log(res.data)
                    }).catch(err => {
                    console.log(err)
                })
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
    },
    mounted() {
        this.getLessonHomework()
        this.getTaskTypes()
    }
}
</script>

<style scoped>
 #blockSixth {
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
