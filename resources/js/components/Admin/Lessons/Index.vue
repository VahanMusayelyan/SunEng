<template>
    <div class="w-100 d-inline-block content-dashboard">
        <div class="w-25 d-inline-block float-left">
            <div class="form-group">
                <h4 class="ml-3 mb-2 orangeText">Add New Lesson</h4>
                <div class="col-12  mb-3">
                    <input autocomplete="off" v-model="lesson" placeholder="Lesson Name" class="form-control" id="lesson" ref="lesson"
                           type="text" required>
                    <select v-model="subcourse" class="selectBackground mt-3" name="lesson" id="lessonList" @change="showSubCourseLessons">
                        <option :value="null" disabled>Choose Course</option>
                        <optgroup v-for="(course, index) in courses" v-bind:label="course.course">
                            <option v-for="(children, ind) in course.children" v-bind:value="children.id">
                                {{ children.course }}
                            </option>
                        </optgroup>
                    </select>
                    <button type="button" class="btn btn-primary mt-3" @click.prevent="addLesson">Submit</button>
                </div>
            </div>
        </div>
        <div class="lesson_table d-inline-block">
            <h4 class="ml-3 mb-2 orangeText">Lessons list</h4>
            <table class="table table-bordered">
                <thead>
                <th>Level</th>
                <th>Lesson</th>
                <th>Actions</th>
                </thead>
                <tbody v-if="lessons">
                <tr v-for="(item, ind) in lessons">
                    <td>{{ item.course.parent.course }} <i class="fas fa-arrow-right"></i> {{ item.course.course }}</td>
                    <td>
                        <router-link :to="{ name: 'lesson', params: { id: item.id }}">
                            {{ item.lesson }}
                        </router-link>
                    </td>
                    <td>
                        <i class="fa fa-edit cursor-pointer" @click.prevent="editLesson(item.id)"></i>
                        <i class="fa fa-trash cursor-pointer mr-3 ml-3" @click.prevent="deleteModal(item.id, 'deleteLesson')"></i>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <modal name="editLessonModal" class="editLessonModal showModal" id="showModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group pt-5">
                    <h4 class="ml-3 mb-2 orangeText">Edit Lesson</h4>
                    <div class="col-12">
                        <input autocomplete="off" v-model="editLess" placeholder="Lesson Name" class="form-control" id="editLess"
                               type="text" required>
                        <select v-model="courseId" class="selectBackground mt-3" name="lesson" id="courseId">
                            <option :value="null" disabled>Choose Course</option>
                            <optgroup v-for="(course, index) in courses" v-bind:label="course.course">
                                <option v-for="(children, ind) in course.children" v-bind:value="children.id">
                                    {{ children.course }}
                                </option>
                            </optgroup>
                        </select>
                    </div>
                    <input autocomplete="off" type="text" hidden v-model="lessonId">
                    <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="updateLesson">Update
                    </button>
                </div>
            </div>

        </modal>

                <modal name="deleteLesson" class="deleteLesson showModal"  id="showModal">
                    <div class="backgroundImg position-absolute"></div>
                    <div class="col-12 p-5">
                        <div class="form-group">
                            <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete lesson ?</h4>
                            <input autocomplete="off" type="text" hidden v-model="deleteId">
                            <div class="w-50 ml-auto  mr-auto">
                                <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deleteLesson">Confirm</button>
                                <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="cancelModal('deleteLesson')">Cancel</button>
                            </div>

                        </div>
                    </div>
                </modal>


    </div>
</template>

<script>
import API from "../../../api";

export default {
    name: "Index",
    data() {
        return {
            lessons: null,
            lesson: null,
            courses: null,
            subcourse: null,
            editLess: null,
            lessonId: null,
            courseId: null,
            deleteId: null,
        }
    },
    methods: {
        getCourses() {
            API.get("/api/dashboard/courses")
                .then(res => {
                    this.courses = res.data.cat
                }).catch(error => {
                console.log(error)
            })
        },
        addLesson() {
            API.post("/api/dashboard/add-lesson", {lesson: this.lesson, subcourse: this.subcourse}).then(response => {
                this.lessons = response.data.lessons
                this.lesson = ""
                this.showSuccessMsg()
            }).catch(error => {
                console.log(error)
            })
        },
        editLesson(id) {
            API.post("/api/dashboard/edit-lesson", {id: id}).then(response => {
                this.editLess = response.data.lesson
                this.courseId = response.data.course_id
                this.lessonId = response.data.id
                this.$modal.show('editLessonModal')
            }).catch(error => {
                console.log(error)
            })
        },
        updateLesson() {
            API.post("/api/dashboard/update-lesson", {id: this.lessonId, course_id: this.courseId, lesson: this.editLess})
                .then(response => {
                    this.$modal.hide('editLessonModal')
                    this.lessons = response.data.lessons
                    this.editLess = ""
                    this.courseId = ""
                    this.showSuccessMsg()
                }).catch(error => {
                console.log(error)
            })
        },
        deleteLesson() {
            API.post("/api/dashboard/delete-lesson", {id : this.deleteId})
                .then(res => {
                    this.cancelModal('deleteLesson')
                    this.lessons = res.data.lessons
                }).catch(error => {
                console.log(error)
            })

        },
        showSubCourseLessons(){
            API.post("/api/dashboard/lessons-list-course", {course_id : this.subcourse}).then(response => {
                this.lessons = response.data.lessons
                console.log(this.lessons)
                this.showInfoMsg()
            }).catch(error => {
                console.log(error)
            })
        }
    },
    mounted() {
        this.getCourses()
    }
}
</script>

<style scoped>
.form-control:focus, .form-control {
    background-color: #f1f1f1;
}

.selectBackground {
    padding: 10px 5px;
    width: 100%;
    background-color: #f1f1f1;
    border-radius: 5px;
}

.lesson_table {
    width: 70%;
}

</style>
