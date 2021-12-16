<template>
    <div class="w-100 d-inline-block content-dashboard">
        <div v-if="courses">
            <ul>
                <li class="d-block" v-for="(course, index) in courses" :key="index" v-if="course.course_id == 0">
                    <a href="#" v-if="course.course_id == 0">
                        <span class="text-uppercase font-weight-bold">{{course.course}}</span>
                        <ul class="d-block pl-4" v-if="course.children.length">
                            <li v-for="(child, ind) in course.children" :key="ind">
                                <router-link :to="{ name: 'dashboard.course', params: { id: child.id }}">{{child.course}}</router-link>
                            </li>
                        </ul>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import API from "./../../../api"

export default {
    name: "Courses",
    data() {
        return {
            courses: null,
            link: "https://laracasts.com/discuss/channels/laravel/getting-vue-to-move-category-depending-on-category-id?page=1",
            link1: "https://forum.vuejs.org/t/create-v-model-for-lists-with-children-and-save-data-to-other-state-variable/47471",
            link2: "https://laracasts.com/discuss/channels/laravel/how-to-open-list-where-parent-id-1",
        }
    },
    methods: {
        getCourses() {
            API.post("/api/dashboard/courses")
                .then(res => {
                    this.courses = res.data.cat
                }).catch(error => {
                console.log(error)
            })
        }
    },
    mounted() {
        this.checkAdmin()
        this.getCourses();
    }
}
</script>

<style scoped>

</style>
