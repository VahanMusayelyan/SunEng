<template>
    <div class="w-100 d-inline-block content-dashboard">
        <div class="d-flex">
            <div class="form-group mr-5">
                <h6 class="ml-3 mb-2 orangeText">New Slide</h6>
                <div class="col-12">
                    <input v-model="slide" placeholder="Slide name" class="form-control w-100 d-inline-block"
                           id="slide"
                           ref="slide" type="text" required>

                </div>
                <button class="btn btn-primary ml-3 mt-3" @click.prevent="addSlide">Add slide</button>
            </div>
            <div v-if="slides && slides.length > 0">
                <h4 class="mb-3">Slides</h4>
                <ul>
                    <li v-for="(item , ind) in slides">
                        <i class="fa fa-trash cursor-pointer mr-1" @click.prevent="deleteModal(item.id, 'deleteSlide')"></i>
                        <i class="fa fa-edit cursor-pointer mr-1" @click.prevent="editModal(item.id)"></i>
                        {{ ++ind }}) {{ item.slide }}
                    </li>
                </ul>
            </div>
        </div>


        <modal name="editSlideModal" class="editSlideModal showModal" id="editSlideModal">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group">
                    <h4 class="mb-2 orangeText">Edit slide</h4>
                    <input v-model="editSlide" placeholder="Slide" class="form-control w-75 d-inline-block"
                           id="slideEdit"
                           ref="slideEdit" type="text" required>
                    <input type="text" hidden v-model="editId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="updateSlide()">
                            Update
                        </button>
                        <button class="ml-3 btn btn-primary mt-3" type="button"
                                @click.prevent="cancelModal('editSlideModal')">Cancel
                        </button>
                    </div>

                </div>
            </div>
        </modal>

        <modal name="deleteSlide" class="deleteSlide showModal" id="deleteSlide">
            <div class="backgroundImg position-absolute"></div>
            <div class="col-12 p-5">
                <div class="form-group">
                    <h4 class="ml-3 mb-2 orangeText text-center">Do you want delete slide ?</h4>
                    <input type="text" hidden v-model="deleteId">
                    <div class="w-50 ml-auto  mr-auto">
                        <button class="ml-3 btn btn-primary mt-3" type="button" @click.prevent="deleteSlide()">
                            Confirm
                        </button>
                        <button class="ml-3 btn btn-primary mt-3" type="button"
                                @click.prevent="cancelModal('deleteSlide')">Cancel
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
    name: "SlideIndex",
    data() {
        return {
            slides: null,
            editId: null,
            editSlide: null,
            slide: null,
        }
    },
    methods: {
        getSlides() {
            API.get("/api/dashboard/slides")
                .then(res => {
                    this.slides = res.data.slides
                }).catch(err => {
                console.log(err)
            })
        },
        deleteSlide() {
            API.post("/api/dashboard/delete-slide", {id: this.deleteId})
                .then(res => {
                    this.slides = res.data.slides
                    this.cancelModal("deleteSlide")
                    this.showSuccessMsg()
                }).catch(err => {
                console.log(err)
            })
        },
        editModal(id) {
            this.editId = id
            API.post("/api/dashboard/edit-slide", {id: this.editId})
                .then(res => {
                    this.editSlide = res.data.slide.slide
                    this.editId = res.data.slide.id
                    this.showModal("editSlideModal")
                }).catch(err => {
                console.log(err)
            })
        },
        updateSlide() {
            API.post("/api/dashboard/update-slide", {id: this.editId, slide: this.editSlide})
                .then(res => {
                    this.cancelModal("editSlideModal")
                    this.editSlide = ""
                    this.editId = ""
                    this.slides = res.data.slides
                    this.showSuccessMsg()
                }).catch(err => {
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
    },
    mounted() {
        this.getSlides()
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
