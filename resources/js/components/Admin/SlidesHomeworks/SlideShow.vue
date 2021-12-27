<template>
    <div class="w-100 d-inline-block content-dashboard">
        <div class="d-flex">
            <div class="w-30">
                <div class="form-group mr-5">
                    <h5></h5>
                    <h6 class="ml-3 mb-2 orangeText">Slide New Task Name</h6>
                    <div class="col-12">
                        <textarea v-model="slideTask" placeholder="Slide task name" class="form-control w-100 d-inline-block"
                               id="slideTask"
                                  ref="slideTask" type="text" required rows="5"></textarea>

                    </div>
                    <button class="btn btn-primary ml-3 mt-3" @click.prevent="addSlideTask">Add slide task</button>
                </div>
                <router-link :to="{name: 'slides.index'}">Back to slides</router-link>
            </div>
            <div v-if="slidesTasks && slidesTasks.length > 0">
                <h4 class="mb-3">{{slideName}}</h4>
                <ul class="tasks">
                    <li v-for="(item , ind) in slidesTasks">
                        <i class="fa fa-trash cursor-pointer mr-2" @click.prevent="deleteModal(item.id, 'deleteSlideTask')"></i>
                        <i class="fa fa-edit cursor-pointer mr-2" @click.prevent="editModal(item.id)"></i>
<!--                        <router-link :to="{ name: 'slide.show', params: { id: item.id }}">-->
                            {{ ++ind }}) {{item.task}}
<!--                        </router-link>-->
                    </li>
                </ul>
            </div>
        </div>


        <modal name="editSlidTaskeModal" class="editSlideModal showModal" id="editSlideModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group">
                    <h4 class="mb-2 orangeText">Edit slide</h4>
                    <textarea v-model="editSlideTask" placeholder="Slide" class="form-control w-75 d-inline-block"
                           id="slideTaskEdit"
                              ref="slideTaskEdit" type="text" required></textarea>
                    <input type="text" hidden v-model="editId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="updateSlideTask()">
                            Update
                        </button>
                        <button class="ml-3 btn btn-primary mt-3" type="button"
                                @click.prevent="cancelModal('editSlidTaskeModal')">Cancel
                        </button>
                    </div>

                </div>
            </div>
        </modal>

        <modal name="deleteSlideTask" class="deleteSlideTask showModal" id="deleteSlideTask">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group">
                    <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete slide task ?</h4>
                    <input type="text" hidden v-model="deleteId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deleteSlideTask()">
                            Confirm
                        </button>
                        <button class="ml-3 btn btn-primary mt-3" type="button"
                                @click.prevent="cancelModal('deleteSlideTask')">Cancel
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
    name: "SlideShow",
    data() {
        return {
            slideTask: null,
            id: this.$route.params.id,
            slidesTasks: null,
            editSlideTask: null,
            editId: null,
            slideName : null,
        }
    },
    methods :{
        getSlide(){
          API.post('/api/dashboard/slide-tasks', {id: this.id})
            .then(res => {
                this.slidesTasks = res.data.slideTasks.tasks
                this.slideName = res.data.slideTasks.slide_name.slide
            }).catch(err => {
              console.log(err)
          })
        },
        addSlideTask(){
            API.post('/api/dashboard/slide-task-add', {task: this.slideTask, slideId: this.id})
                .then(res => {
                    this.slidesTasks = res.data.slideTasks.tasks
                    this.slideTask = ""
                    this.showSuccessMsg()
                }).catch(err => {
                console.log(err)
            })
        },
        editModal(id){
            API.post('/api/dashboard/slide-task-edit', {id: id})
            .then(res => {
                this.editSlideTask = res.data.task
                this.editId = res.data.id
                this.showModal("editSlidTaskeModal")
            }).catch(err => {
                console.log(err)
            })
        },
        updateSlideTask(){
            API.post('/api/dashboard/slide-task-update', {id: this.editId, slideTask : this.editSlideTask, slideId : this.id})
                .then(res => {
                    this.slidesTasks = res.data.slideTasks.tasks
                    this.cancelModal("editSlidTaskeModal")
                    this.showSuccessMsg()
                }).catch(err => {
                console.log(err)
            })
        },
        deleteSlideTask(){
            API.post('/api/dashboard/slide-task-delete', {id: this.deleteId, slideId: this.id})
                .then(res => {
                    this.slidesTasks = res.data.slideTasks.tasks
                    this.cancelModal("deleteSlideTask")
                    this.showSuccessMsg()
                }).catch(err => {
                console.log(err)
            })
        }
    },
    mounted() {
        this.getSlide()
    }
}
</script>

<style scoped>
.tasks li{
    display: block;
}
</style>
