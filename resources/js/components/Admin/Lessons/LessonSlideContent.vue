<template>
    <div class="w-100 d-inline-block content-dashboard">
        <h4 v-if="lessonSlide">Slide - {{lessonSlide.slide_name.slide}}</h4>
    </div>
</template>

<script>
import API from "../../../api";
export default {
    name: "LessonSlideContent",
    data(){
        return{
            lessonSlideId: null,
            lessonSlide: null,
        }
    },
    methods :{
        getLessonHomework(){
            this.lessonSlideId = parseInt(this.$route.params.id)
            API.post("/api/dashboard/lesson-slide", {id : this.lessonSlideId})
            .then(res => {
                this.lessonSlide = res.data.lessonSlide
            })
            .catch(err => {

            })
        }
    },
    mounted() {
        this.getLessonHomework()
    }
}
</script>

<style scoped>

</style>
