<template>
    <div class="w-100 d-inline-block content-dashboard">
        <div class="d-flex">
            <div class="form-group mr-5">
                <h6 class="ml-3 mb-2 orangeText">New Homework</h6>
                <div class="col-12">
                    <input v-model="homework" placeholder="Homework name" class="form-control w-100 d-inline-block"
                           id="homework"
                           ref="homework" type="text" required>

                </div>
                <button class="btn btn-primary ml-3 mt-3" @click.prevent="addHomework">Add homework</button>
            </div>
            <div v-if="homeworks && homeworks.length > 0">
                <h4 class="mb-3">Homeworks</h4>
                <ul>
                    <li v-for="(work , ind) in homeworks">
                        <i class="fa fa-trash cursor-pointer mr-1" @click.prevent="deleteModal(work.id, 'deleteHomework')"></i>
                        <i class="fa fa-edit cursor-pointer mr-1" @click.prevent="editModal(work.id)"></i>
                        {{ ++ind }}) {{ work.homework }}
                    </li>
                </ul>
            </div>
        </div>


        <modal name="editHomeworkModal" class="editHomeworkModal showModal" id="editHomeworkModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group">
                    <h4 class="mb-2 orangeText">Edit homework</h4>
                    <input v-model="editHomework" placeholder="Homework" class="form-control w-75 d-inline-block"
                           id="homeworkEdit"
                           ref="homeworkEdit" type="text" required>
                    <input type="text" hidden v-model="editId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="updateHomework()">
                            Update
                        </button>
                        <button class="ml-3 btn btn-primary mt-3" type="button"
                                @click.prevent="cancelModal('editHomeworkModal')">Cancel
                        </button>
                    </div>

                </div>
            </div>
        </modal>

        <modal name="deleteHomework" class="deleteHomework showModal" id="deleteHomework">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group">
                    <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete homework ?</h4>
                    <input type="text" hidden v-model="deleteId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deleteHomework()">
                            Confirm
                        </button>
                        <button class="ml-3 btn btn-primary mt-3" type="button"
                                @click.prevent="cancelModal('deleteHomework')">Cancel
                        </button>
                    </div>

                </div>
            </div>
        </modal>

    </div>
</template>

<script>
import API from "../../../api";

export default {
    name: "HomeworkIndex",
    data() {
        return {
            homeworks: null,
            editId: null,
            editHomework: null,
            homework: null,
        }
    },
    methods: {
        getHomeworks() {
            API.get("/api/dashboard/homeworks")
                .then(res => {
                    this.homeworks = res.data.homeworks
                }).catch(err => {
                console.log(err)
            })
        },
        deleteHomework() {
            API.post("/api/dashboard/delete-homework", {id: this.deleteId})
                .then(res => {
                    this.homeworks = res.data.homeworks
                    this.cancelModal("deleteHomework")
                    this.showSuccessMsg()
                }).catch(err => {
                console.log(err)
            })
        },
        editModal(id) {
            this.editId = id
            API.post("/api/dashboard/edit-homework", {id: this.editId})
                .then(res => {
                    this.editHomework = res.data.homework.homework
                    this.editId = res.data.homework.id
                    this.showModal("editHomeworkModal")
                }).catch(err => {
                console.log(err)
            })
        },
        updateHomework() {
            API.post("/api/dashboard/update-homework", {id: this.editId, homework: this.editHomework})
                .then(res => {
                    this.cancelModal("editHomeworkModal")
                    this.editHomework = ""
                    this.editId = ""
                    this.homeworks = res.data.homeworks
                    this.showSuccessMsg()
                }).catch(err => {
                console.log(err)
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
    },
    mounted() {
        this.getHomeworks()
    }
}
</script>

<style scoped>
ul {
    -moz-column-count: 2;
    -moz-column-gap: 40px;
    -webkit-column-count: 2;
    -webkit-column-gap: 40px;
    column-count: 2;
    column-gap: 40px;
}
ul li{
    display: block;
    margin: 0 10px 10px 0;
}
</style>
