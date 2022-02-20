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

            <!-- Phrase tasks -->
            <div id="blockSeventh" class="w-75 mt-3 ml-5  border p-3 blocksTasks">
                <div class="form-group">
                    <label for="questionPhrase">Please write sentence</label>
                    <input autocomplete="off" class="form-control" v-model="questionPhrase" id="questionPhrase">
                </div>
                <div class="form-group">
                    <label for="questionPhrase">Please write correct word</label>
                    <input autocomplete="off" class="form-control" v-model="phraseCorrect" id="phraseCorrect">
                </div>
                <div class="form-group">
                    <label for="questionPhrase">Please write example word</label>
                    <input autocomplete="off" class="form-control" v-model="phraseExample" id="phraseExample">
                </div>
                <div class="form-group">
                    <button @click="addPhraseTask()" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- End Phrase tasks -->
        </div>


        <div class="border mt-3 pt-3 pl-2">
            <h4>tasks</h4>
            <ol v-if="(phraseTasks && phraseTasks.length > 0)">
                <li class="mt-2" v-for="(phraseTask , ind) in phraseTasks" :value="phraseTask.id">
                    <i @click="editPhraseTask(phraseTask.id)" class="fa fa-edit mr-2 cursor-pointer"></i>
                    <i @click="deletePhraseTask(phraseTask.id)" class="fa fa-trash mr-2 cursor-pointer"></i>
                    {{ phraseTask.phrase_text }}
                    <p class="mt-2 ml-4"><b>Correct :</b>
                        <span>
                           {{ phraseTask.correct }}
                            </span>
                    </p>
                    <p class="mt-2 ml-4"><b>Hint :</b>
                        <span>
                           {{ phraseTask.example }}
                            </span>
                    </p>
                </li>
            </ol>
        </div>

        <!-- Phrase tasks modal -->
        <modal name="editPhraseModal" class="editLessonModal showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 pl-5 pr-5">
                <div class="form-group">
                    <h4 class="ml-3 mb-2 orangeText">Edit sentence</h4>
                    <div class="col-12">
                        <label for="editPhrase">Phrase</label>
                        <input autocomplete="off" v-model="editPhrase" placeholder="Question" class="form-control" id="editPhrase"
                               type="text" required>
                    </div>
                    <div class="col-12 mt-2">
                        <label for="editCorrect">Correct</label>
                        <input autocomplete="off" v-model="editCorrect" placeholder="Correct" class="form-control" id="editCorrect"
                               type="text" required>
                    </div>
                    <div class="col-12 mt-2">
                        <label for="editExample">Example</label>
                        <input autocomplete="off" v-model="editExample" placeholder="Example" class="form-control" id="editExample"
                               type="text" required>
                    </div>
                    <input autocomplete="off" type="text" hidden v-model="editId">
                    <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="updatePhraseTask">Update
                    </button>
                </div>
            </div>
        </modal>

        <modal name="deletePhrase" class="deleteMain showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete task ?</h4>
                    <input autocomplete="off" type="text" hidden v-model="deleteId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deletePhraseTask">
                            Confirm
                        </button>
                        <button class="ml-3 btn btn-primary mt-3" type="button"
                                @click.prevent="cancelModal('deletePhrase')">Cancel
                        </button>
                    </div>

                </div>
            </div>
        </modal>
        <!-- End Phrase tasks modal -->


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
            phraseTasks: null,
            editPhrase: null,
            editExample: null,
            editCorrect: null,
            questionPhrase: null,
            phraseExample: null,
            phraseCorrect: null,
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

            document.querySelector("#blockSeventh").style.display = "none";


            this.phraseTasks = null

            if (this.typeId === 7) {
                document.querySelector("#blockSeventh").style.display = "block";

                API.post('/api/dashboard/phrase-tasks', {lessonSlideId: this.lessonSlideId})
                    .then(res => {
                        this.phraseTasks = res.data
                        console.log(res.data)
                    }).catch(err => {
                    console.log(err)
                })
            }

        },
        addPhraseTask() {
            if(!this.questionPhrase){
                this.showErrorMsg()
                return false
            }
            API.post('/api/dashboard/add-phrase-task', {
                questionPhrase: this.questionPhrase,
                phraseCorrect: this.phraseCorrect,
                phraseExample: this.phraseExample,
                lessonSlideId: this.lessonSlideId,
            })
                .then(res => {
                    if(res.data === 0){
                        this.showErrorMsg()
                    }else{
                        this.editId = null
                        this.deleteId = null
                        this.questionPhrase = null
                        this.showSuccessMsg()
                        this.phraseTasks = res.data
                    }
                }).catch(err => {
                console.log(err)
            })

        },
        editPhraseTask(id) {
            API.post('/api/dashboard/edit-phrase-task', {id: id})
                .then(res => {
                    if(res.data === 0){
                        this.showErrorMsg()
                    }else{
                        this.editPhrase = res.data.phrase_text
                        this.editCorrect = res.data.correct
                        this.editExample = res.data.example
                        this.editId = res.data.id
                        this.showModal("editPhraseModal")
                        this.showInfoMsg()
                    }
                }).catch(err => {
                console.log(err)
            })
        },
        updatePhraseTask(id) {
            API.post('/api/dashboard/update-phrase-task', {
                id: this.editId,
                editPhrase: this.editPhrase,
                editCorrect: this.editCorrect,
                editExample: this.editExample,
                lessonSlideId: this.lessonSlideId,
            })
                .then(res => {
                    if(res.data === 0){
                        this.showErrorMsg()
                    }else {
                        this.editId = null
                        this.editPhrase = null
                        this.phraseTasks = res.data
                        this.cancelModal("editPhraseModal")
                        this.showSuccessMsg()
                    }
                }).catch(err => {
                console.log(err)
            })
        },
        deletePhraseTask(id) {
            if (this.deleteId) {
                API.post('/api/dashboard/delete-phrase-task', {id: this.deleteId, lessonSlideId: this.lessonSlideId})
                    .then(res => {
                        if(res.data === 0){
                            this.showErrorMsg()
                        }else {
                            this.editId = null
                            this.deleteId = null
                            this.cancelModal("deletePhrase")
                            this.showSuccessMsg()
                            this.phraseTasks = res.data
                        }
                    }).catch(err => {
                    console.log(err)
                })
            } else {
                this.deleteModal(id, "deletePhrase")
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
 #blockSeventh {
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
