<template>
    <div class="w-100 d-inline-block content-dashboard position-relative">
        <h4 class="text-uppercase font-weight-bold">{{course}} course</h4>
        <h6 class="orangeText">{{level}} level</h6>
        <p>Lessons</p>
        <ul v-if="lessons">
            <li class="d-block" v-for="(lesson , ind) in lessons">
                {{ind+1}}.
                <router-link :to="{ name: 'lesson', params: { id: lesson.id }}">
                        {{lesson.lesson}}
                </router-link>
            </li>
        </ul>
        <p v-if="!lessons.length">There is no lessons</p>
        <div class="position-absolute routing"><router-link :to="{name: 'dashboard.courses'}">Back to courses</router-link></div>
    </div>
</template>

<script>
import API from "../../../api";

export default {
    name: "CourseIndex",
    data() {
        return {
            lessons: null,
            course_id : null,
            course: null,
            level: null,
        }
    },
    methods: {
        getCourses(){
            this.course_id = parseInt(this.$route.params.id)

            if(!Number.isInteger(this.course_id)) return false;
            API.post("/api/dashboard/course-lessons", {course_id : this.course_id})
            .then(response => {
                this.course = response.data.course.parent.course
                this.level = response.data.course.course
                this.lessons = response.data.lessons
            }).catch(error =>{
                console.log(error)
            })
        }
    },
    created() {
        this.getCourses()
    },
    mounted() {

    }
}
</script>

<style scoped>
.routing{
    bottom: 10px;
}
</style>
