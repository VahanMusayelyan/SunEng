<template>
    <div class="w-100 d-inline-block content-dashboard">
        <div class="d-flex">
            <div class="w-25">
                <div class="form-group">
                    <h4 class="ml-3 mb-2 orangeText">Add New Course</h4>
                    <div class="col-12">
                        <input v-model="mainCourse" placeholder="Course Name" class="form-control" id="maincourse" ref="maincourse" type="text" required>
                    </div>
                </div>
                <button class="ml-3 btn btn-primary" type="button" @click.prevent="addMainCourse">Submit</button>
            </div>
            <div class="w-25">
                    <div class="form-group">
                        <h4 class="ml-3 mb-2 orangeText">Add New Sub Course</h4>
                        <div class="col-12">
                            <input v-model="courseName" placeholder="Sub Course Name" class="form-control" id="course" ref="course" type="text" required>
                        </div>
                        <div  class="col-12 mt-3">
                            <select  v-model="parentId"  class="select_parent" name="parent_courses" ref="parent_courses" id="parent_courses">
                                <option :value="null" disabled>Choose Parent Course</option>
                                <option v-for="parent in parents" v-bind:value="parent.id">{{ parent.course }}</option>
                            </select>
                        </div>
                    </div>
                    <button class="ml-3 btn btn-primary" type="button" @click.prevent="addCourse">Submit</button>
            </div>

            <div v-if="courses" class="w-25  ml-5">
                <ul>
                    <li class="d-block" v-for="(course, index) in courses" :key="index" v-if="course.course_id == 0">
                        <a v-if="course.course_id == 0">
                            <span class="text-uppercase font-weight-bold">{{ course.course }}</span>
                            <ul class="d-block pl-4" v-if="course.children.length">
                                <li class="d-block" v-for="(child, ind) in course.children" :key="ind">
                                    <i class="fa fa-edit cursor-pointer" @click.prevent="editCourse(child.id)"></i>
                                    <i class="fa fa-trash cursor-pointer mr-2 ml-2" @click.prevent="deleteCourse(child.id)"></i>
                                    <router-link :to="{ name: 'dashboard.course', params: { id: child.id }}">
                                        {{ child.course }}
                                    </router-link>

                                </li>
                            </ul>
                        </a>
                    </li>
                </ul>
            </div>
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
            parents: null,
            courseName : null,
            parentId : null,
            courseId : null,
            mainCourse: null,
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
        },
        getParentCourses() {
            API.post("/api/dashboard/parent-courses")
                .then(res => {
                    this.parents = res.data.parent_courses
                }).catch(error => {
                console.log(error)
            })
        },
        addCourse(){
            if(this.courseName == null) return alert("Please fill course name");
            if(this.parentId == null) return alert("Please choose parent course");
            API.post("/api/dashboard/add-course", {parentId : this.parentId, courseName : this.courseName})
            .then(res => {
                this.courses = res.data.cat
                this.courseName = ""
                this.parentId = null
            }).catch(error => {
                console.log(error)
            })
        },
        //TodDo add modal, click insert modal values => then update course
        editCourse(id){
            API.post("/api/dashboard/edit-course", {courseId : id})
                .then(res => {
                    console.log(res.data.cat.course)
                    this.courseName = res.data.cat.course
                    this.parentId = res.data.cat.course_id
                }).catch(error => {
                console.log(error)
            })
        },
        deleteCourse(){

        },
        addMainCourse(){
            API.post("/api/dashboard/add-main-course", {mainCourse : this.mainCourse})
                .then(res => {
                    this.courses = res.data.cat
                    this.mainCourse = ""
                    this.getParentCourses()
                }).catch(error => {
                console.log(error)
            })
        }
    },
    mounted() {
        this.checkAdmin()
        this.getCourses();
        this.getParentCourses();
    },

}
</script>

<style scoped>
#course, #maincourse {
    background-color: #f1f1f1;
    border-radius: 5px;
}

.select_parent{
    padding: 10px 5px;
    width: 100%;
    background-color: #f1f1f1;
    border-radius: 5px;
}

</style>
