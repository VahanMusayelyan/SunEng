<template>
    <div class="w-100 d-inline-block content-dashboard">
        <h4 class="ml-3 mb-2">Lesson : {{ lesson }}</h4>
        <div class="d-flex">
            <div class="w-30 d-inline-block">
                <div class="form-group">
                    <h6 class="ml-3 mb-2 orangeText">Title</h6>
                    <div class="col-12">
                        <input v-model="lessonTitle" placeholder="Lesson title" class="form-control w-75"
                               id="lessonTitle"
                               ref="lessonTitle" type="text" required>
                    </div>
                </div>
                <button class="ml-3 btn btn-primary" type="button" @click.prevent="addLessonTitle">Submit</button>
            </div>
            <div class="borderDivide d-inline-block"></div>
            <div class="w-30  d-inline-block  ml-2">
                <div class="form-group">
                    <h6 class="ml-3 mb-2 orangeText">Lesson slides</h6>
                    <div class="col-12">
                        <input v-model="slide" placeholder="Lesson slide" class="form-control w-75 d-inline-block"
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
                        <input v-model="homework" placeholder="Lesson homework" class="form-control w-75 d-inline-block"
                               id="lessonHomework"
                               ref="lessonHomework" type="text" required>
                        <i class="fa fa-check addConfirm" @click.prevent="addHomework"></i>
                    </div>
                    <div class="col-12">
                        <select class="select_item w-75 mt-3" v-model="homeworkId" name="homeworkId" id="homeworkId">
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
    </div>
</template>

<script>
import API from "../../../api";

export default {
    name: "Show",
    data() {
        return {
            lesson: null,
            lesson_id: null,
            lessonTitle: null,
            slides: null,
            slide: null,
            homework: null,
            slideId: null,
            homeworks: null,
            homeworkId: null,
        }
    },
    methods: {
        getLesson() {
            this.lesson_id = parseInt(this.$route.params.id)
            API.post("/api/dashboard/lesson-show", {id: this.lesson_id})
                .then(response => {
                    this.lesson = response.data.lesson.lesson
                    this.lessonTitle = response.data.lesson.title
                }).catch(error => {
                console.log(error)
            })
        },
        getSlides() {
            API.post("/api/dashboard/slides-list")
                .then(response => {
                    this.slides = response.data.slides
                }).catch(error => {
                console.log(error)
            })
        },
        addLessonTitle() {
            API.post("/api/dashboard/lesson-title", {id: this.lesson_id, title: this.lessonTitle})
                .then(response => {
                    this.lessonTitle = response.data.lesson.title
                    this.showSuccessMsg()
                }).catch(error => {
                console.log(error)
            })
        },
        addLessonSlide() {

        },
        addLessonHomework() {

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

        }
    },
    mounted() {
        this.getLesson()
        this.getSlides()
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
</style>
