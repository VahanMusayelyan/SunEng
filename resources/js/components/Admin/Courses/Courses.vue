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
                            <i class="fa fa-edit cursor-pointer" @click.prevent="editMainCourse(course.id)"></i>
                            <i class="fa fa-trash cursor-pointer mr-2 ml-2" @click.prevent="deleteModal(course.id)"></i>
                            <span class="text-uppercase font-weight-bold">{{ course.course }}</span>
                            <ul class="d-block pl-4" v-if="course.children.length">
                                <li class="d-block" v-for="(child, ind) in course.children" :key="ind">
                                    <i class="fa fa-edit cursor-pointer" @click.prevent="editCourse(child.id)"></i>
                                    <i class="fa fa-trash cursor-pointer mr-2 ml-2" @click.prevent="deleteModal(child.id)"></i>
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

        <modal name="edit">
            <div class="col-12 p-5">
                <div class="form-group">
                    <h4 class="ml-3 mb-2 orangeText">Edit Sub Course</h4>
                    <div class="col-12">
                        <input v-model="editCourseName" placeholder="Sub Course Name" class="form-control" id="editcourse" ref="editcourse" type="text" required>
                    </div>
                    <div  class="col-12 mt-3">
                        <select  v-model="editParentId"  class="select_parent" name="edit_parent_courses" ref="edit_parent_courses" id="edit_parent_courses">
                            <option :value="null" disabled>Choose Parent Course</option>
                            <option v-for="parent in parents" v-bind:value="parent.id">{{ parent.course }}</option>
                        </select>
                    </div>
                    <input type="text" hidden v-model="editId">
                    <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="updateCourse">Update</button>
                </div>
            </div>
        </modal>

        <modal name="editMain">
            <div class="col-12 p-5">
                <div class="form-group">
                        <h4 class="ml-3 mb-2 orangeText">Edit Course</h4>
                        <div class="col-12">
                            <input v-model="mainEditCourse" placeholder="Course Name" class="form-control" id="maineditcourse" type="text" required>
                        </div>
                    <input type="text" hidden v-model="mainEditId">
                    <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="updateMainCourse">Update</button>
                </div>
            </div>
        </modal>

        <modal name="deleteMain" class="deleteMain">
            <div class="col-12 p-5">
                <div class="form-group">
                    <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete course</h4>
                    <input type="text" hidden v-model="mainDelete">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deleteMainCourse">Confirm</button>
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="cancelMainCourse">Cancel</button>
                    </div>

                </div>
            </div>
        </modal>

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
            editCourseName:null,
            editParentId: null,
            editId: null,
            mainEditCourse: null,
            mainEditId: null,
            mainDelete: null,

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
            this.$modal.show('edit');
            API.post("/api/dashboard/edit-course", {id : id})
                .then(res => {
                    console.log(res.data.cat.course)
                    this.editCourseName = res.data.cat.course
                    this.editParentId = res.data.cat.course_id
                    this.editId = res.data.cat.id
                }).catch(error => {
                console.log(error)
            })
        },
        updateCourse(){
            if(this.editCourseName == null) return alert("Please fill course name");
            if(this.editParentId == null) return alert("Please choose parent course");
            API.post("/api/dashboard/update-course", {parentId : this.editParentId, courseName : this.editCourseName, id: this.editId})
                .then(res => {
                    this.courses = res.data.cat
                    this.editCourseName = ""
                    this.editParentId = null
                    this.$modal.hide("edit")
                    this.showSuccessMsg()
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
        },
        editMainCourse(id){
            this.$modal.show('editMain');
            API.post("/api/dashboard/edit-main-course", {id : id})
                .then(res => {
                    this.mainEditCourse = res.data.cat.course
                    this.mainEditId = res.data.cat.id
                }).catch(error => {
                console.log(error)
            })
        },
        updateMainCourse(){
            if(this.mainEditCourse == null) return alert("Please fill course name");

            API.post("/api/dashboard/update-main-course", {course : this.mainEditCourse, id: this.mainEditId})
                .then(res => {
                    this.courses = res.data.cat
                    this.mainEditCourse = ""
                    this.$modal.hide("editMain")
                    this.showSuccessMsg()
                }).catch(error => {
                console.log(error)
            })
        },
        deleteMainCourse(){
            API.post("/api/dashboard/delete-main-course", {id : this.mainDelete})
                .then(res => {
                    this.courses = res.data.cat
                    this.mainDelete = ""
                    this.$modal.hide("deleteMain")
                    this.showSuccessMsg()
                }).catch(error => {
                console.log(error)
            })
        },
        deleteModal(id){
            this.mainDelete = id;
            this.$modal.show("deleteMain")
        },
        cancelMainCourse(){
            this.$modal.hide("deleteMain")
        }
    },
    mounted() {
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
.deleteMain{
    height: 204px;
    border-radius: 15px;
}
</style>
