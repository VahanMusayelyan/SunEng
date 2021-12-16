<template>
    <div class="w-100 d-inline-block content-dashboard">
        <h1>Category</h1>
    </div>
</template>

<script>
import API from "../../../api";

export default {
    name: "CourseIndex",
    data() {
        return {
            categories: null,
        }
    },
    methods: {

    },
    mounted() {
        this.checkAdmin()
    }
}
</script>

<style scoped>

</style>
