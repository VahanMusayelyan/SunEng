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
        </div>


        <div class="border mt-3 pt-3 pl-2">
            <h4>tasks</h4>
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
        </div>

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
            questionSplit: null,
            deleteId: null,
            url: null,
            editId: null,
            splitTasks: null,
            editSplit: null,
            arr: null,
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

            document.querySelector("#blockFifth").style.display = "none";


            this.splitTasks = null

            if (this.typeId === 5) {
                document.querySelector("#blockFifth").style.display = "block";

                API.post('/api/dashboard/split-tasks', {lessonSlideId: this.lessonSlideId})
                    .then(res => {
                        this.splitTasks = res.data
                        console.log(res.data)
                    }).catch(err => {
                    console.log(err)
                })
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
    },
    mounted() {
        this.getLessonHomework()
        this.getTaskTypes()
    }
}
</script>

<style scoped>
#blockFirst, #blockSecond,#blockThird, #blockFourth, #blockFifth {
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
