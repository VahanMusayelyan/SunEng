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
            <ol v-if="(towPartTasks && towPartTasks.length > 0)">
                <li class="mt-2" v-for="(partTask , ind) in towPartTasks" :value="partTask.id">
                    <i @click="editTwoPartTask(partTask.id)" class="fa fa-edit mr-2 cursor-pointer"></i>
                    <i @click="deleteTwoPartTask(partTask.id)" class="fa fa-trash mr-2 cursor-pointer"></i>
                    {{ partTask.get_first_part.question }} - {{ partTask.get_second_part.question }}
                </li>
            </ol>
        </div>

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
    name: "LessonSlideContentSecond",
    data() {
        return {
            lessonSlideId: null,
            lessonSlide: null,
            taskTypes: null,
            typeId: null,
            deleteId: null,
            url: null,
            editId: null,
            towPartTasks: null,
            editQuestionFirst: null,
            editExample: null,
            editQuestionSecond: null,
            questionFirst: null,
            phraseExample: null,
            questionSecond: null,
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

            document.querySelector("#blockEigth").style.display = "none";


            this.towPartTasks = null

            if (this.typeId === 8) {
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
    },
    mounted() {
        this.getLessonHomework()
        this.getTaskTypes()
    }
}
</script>

<style scoped>
 #blockEigth {
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
