<template>
    <div class="w-100 d-inline-block content-dashboard position-relative">
        <h4 class="ml-3 mb-2">Lesson : {{ lesson }}</h4>
        <div class="d-flex">
            <div class="w-30 d-inline-block position-relative">
                <div class="form-group">
                    <h6 class="ml-3 mb-2 orangeText">Title</h6>
                    <div class="col-12">
                        <input autocomplete="off" v-model="lessonTitle" placeholder="Lesson title" class="form-control w-75"
                               id="lessonTitle"
                               ref="lessonTitle" type="text" required>
                    </div>
                </div>
                <button class="ml-3 btn btn-primary" type="button" @click.prevent="addLessonTitle">Submit</button>
                <div class="position-absolute routing">
                    <router-link :to="{name: 'dashboard.course', params: { id: courseId }}">Back to lessons</router-link>
                </div>
            </div>
            <div class="borderDivide d-inline-block"></div>
            <div class="w-30  d-inline-block  ml-2">
                <div class="form-group">
                    <h6 class="ml-3 mb-2 orangeText">Lesson slides</h6>
                    <div class="col-12">
                        <input autocomplete="off" v-model="slide" placeholder="Lesson slide" class="form-control w-75 d-inline-block"
                               id="slide"
                               ref="slide" type="text" required>
                        <i class="fa fa-check addConfirm" @click.prevent="addSlide"></i>
                    </div>
                    <div class="col-12">
                        <select class="select_item w-75 mt-3" v-model="slideId" name="slide" id="slides" multiple>
                            <option :value="null" disabled>Choose lesson slides</option>
                            <option v-for="(item, index) in slides"  :value="item.id">
                                {{item.slide}}
                            </option>
                        </select>
                    </div>
                </div>
                <button class="ml-3 btn btn-primary" type="button" @click.prevent="addLessonSlide">Submit</button>
            </div>
            <div class="borderDivide d-inline-block"></div>
            <div class="w-30 d-inline-block ml-2">
                <div class="form-group">
                    <h6 class="ml-3 mb-2 orangeText">Lesson homework</h6>
                    <div class="col-12">
                        <input autocomplete="off" v-model="homework" placeholder="Lesson homework" class="form-control w-75 d-inline-block"
                               id="lessonHomework"
                               ref="lessonHomework" type="text" required>
                        <i class="fa fa-check addConfirm" @click.prevent="addHomework"></i>
                    </div>
                    <div class="col-12">
                        <select class="select_item w-75 mt-3" v-model="homeworkId" name="homeworkId" id="homeworkId" multiple>
                            <option :value="null" disabled>Choose lesson homework</option>
                            <option v-for="(work, index) in homeworks" :value="work.id">
                                {{work.homework}}
                            </option>
                        </select>
                    </div>
                </div>
                <button class="ml-3 btn btn-primary" type="button" @click.prevent="addLessonHomework">Submit</button>
            </div>
        </div>
        <div class="d-flex mt-4 border-top p-3">
            <div class="w-50" v-if="slidesLesson && slidesLesson.length > 0">
                <h4>Lesson Slides</h4>
                <p v-for="(slideItem , ind) in slidesLesson">
                    <i class="fa fa-trash cursor-pointer" @click.prevent="deleteModal(slideItem.id, 'deleteLessonModal')"></i>
                    <router-link :to="{ name: 'lesson.slide.content', params: { id: slideItem.id }}">
                    {{++ind}}) {{slideItem.slide_name.slide}}
                    </router-link>
                </p>
            </div>
            <div  class="w-50" v-if="homeworksLesson && homeworksLesson.length > 0">
                <h4>Lesson Homeworks</h4>
                <p v-for="(workItem , index) in homeworksLesson">
                    <i class="fa fa-trash cursor-pointer" @click.prevent="deleteModal(workItem.id, 'deleteLessonModalWork')"></i>
                    <router-link :to="{ name: 'lesson.homework.content', params: { id: workItem.id }}">
                    {{++index}}) {{workItem.homework_name.homework}}
                    </router-link>
                </p>
            </div>
        </div>

        <modal name="deleteLessonModal" class="deleteLesson showModal"  id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group">
                    <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete lesson's slide ?</h4>
                    <input autocomplete="off" type="text" hidden v-model="deleteId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deleteLessonSlide()">Confirm</button>
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="cancelModal('deleteLessonModal')">Cancel</button>
                    </div>

                </div>
            </div>
        </modal>
        <modal name="deleteLessonModalWork" class="deleteLesson showModal"  id="deleteLessonModalWork">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group">
                    <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete lesson's homework ?</h4>
                    <input autocomplete="off" type="text" hidden v-model="deleteId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deleteLessonWork()">Confirm</button>
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="cancelModal('deleteLessonModalWork')">Cancel</button>
                    </div>

                </div>
            </div>
        </modal>
    </div>
</template>

<script>
import API from "../../../api";

export default {
    name: "Show",
    data() {
        return {
            lesson: null,
            lesson_id: parseInt(this.$route.params.id),
            lessonTitle: null,
            slides: null,
            slide: null,
            homework: null,
            slideId: [],
            homeworks: null,
            slidesLesson: null,
            homeworksLesson: null,
            homeworkId: [],
            slideLessId: null,
            deleteId: null,
            courseId: null,
        }
    },
    methods: {
        getLesson() {
            API.post("/api/dashboard/lesson-show", {id: this.lesson_id})
                .then(response => {
                    this.lesson = response.data.lesson.lesson
                    this.courseId = response.data.lesson.course.id
                    this.lessonTitle = response.data.lesson.title
                }).catch(error => {
                console.log(error)
            })
        },
        getSlides() {
            API.get("/api/dashboard/slides")
                .then(response => {
                    this.slides = response.data.slides
                }).catch(error => {
                console.log(error)
            })
        },
        getHomeworks() {
            API.get("/api/dashboard/homeworks")
                .then(response => {
                    this.homeworks = response.data.homeworks
                }).catch(error => {
                console.log(error)
            })
        },

        getSlideWork(){
            API.post("/api/dashboard/slides-and-homeworks", {lesson_id: this.lesson_id})
            .then(res => {
                this.homeworksLesson = res.data.homeworksLesson
                this.slidesLesson = res.data.slidesLesson
            }).catch(err => {
                console.log(err)
            })
        },

        addLessonTitle() {
            if(this.lessonTitle.length < 1) return this.showWarnMsg()
            API.post("/api/dashboard/lesson-title", {id: this.lesson_id, title: this.lessonTitle})
                .then(response => {
                    this.lessonTitle = response.data.lesson.title
                    this.showSuccessMsg()
                }).catch(error => {
                console.log(error)
            })
        },
        addLessonSlide() {
            if(this.slideId.length < 1) return this.showWarnMsg()
            API.post("/api/dashboard/add-lesson-slide", {lesson_id: this.lesson_id, slides: this.slideId})
            .then(res => {
                if(res.data.error && res.data.error !== ""){
                    this.showErrorMsg()
                }else {
                    this.homeworksLesson = res.data.homeworksLesson
                    this.slidesLesson = res.data.slidesLesson
                    this.slideId = [];
                    this.showSuccessMsg()
                }
            }).catch(err=>{
                console.log(err)
            })

        },
        addLessonHomework() {
            if(this.homeworkId.length < 1) return this.showWarnMsg()
            API.post("/api/dashboard/add-lesson-homework", {lesson_id: this.lesson_id, homeworks: this.homeworkId})
                .then(res => {
                    if(res.data.error && res.data.error !== ""){
                        this.showErrorMsg()
                    }else{
                        this.homeworksLesson = res.data.homeworksLesson
                        this.slidesLesson = res.data.slidesLesson
                        this.homeworkId = [];
                        this.showSuccessMsg()
                    }

                }).catch(err=>{
                console.log(err)
            })
        },
        addSlide() {
            API.post("/api/dashboard/add-slide", {slide: this.slide})
                .then(response => {
                    this.slides = response.data.slides
                    this.slide = ""
                    this.showSuccessMsg()
                }).catch(error => {
                console.log(error)
            })
        },
        addHomework() {
            API.post("/api/dashboard/add-homework", {homework: this.homework})
                .then(response => {
                    this.homeworks = response.data.homeworks
                    this.homework = ""
                    this.showSuccessMsg()
                }).catch(error => {
                console.log(error)
            })
        },
        deleteLessonWork(){
            API.post("/api/dashboard/delete-lesson-homework", {lesson_id: this.lesson_id, id : this.deleteId})
            .then(res =>{
                this.homeworksLesson = res.data.homeworksLesson
                this.slidesLesson = res.data.slidesLesson
                this.deleteId = ""
                this.cancelModal('deleteLessonModalWork')
                this.showSuccessMsg()
            }).catch(err => {

            })

        },
        deleteLessonSlide(){
            API.post("/api/dashboard/delete-lesson-slide", {lesson_id: this.lesson_id , id : this.deleteId})
                .then(res =>{
                    this.homeworksLesson = res.data.homeworksLesson
                    this.slidesLesson = res.data.slidesLesson
                    this.deleteId = ""
                    this.cancelModal('deleteLessonModal')
                    this.showSuccessMsg()
                }).catch(err => {

            })

        }

    },
    mounted() {
        this.getLesson()
        this.getSlides()
        this.getHomeworks()
        this.getSlideWork()
    }
}
</script>

<style scoped>
.borderDivide {
    min-height: 100px;
    height: auto;
    border: 1px solid #fa90467a;
    width: 1px;
}

.addConfirm {
    font-size: 25px;
    color: green;
    margin-left: 5px;
    cursor: pointer;
}
.routing{
    bottom: 0;
    left:15px;
}
</style>
