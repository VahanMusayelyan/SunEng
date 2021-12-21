<template>
    <div class="w-100 d-inline-block content-dashboard">
        <h3>This is the Dashboard component for authenticated ADMIN</h3>
        <router-view/>
    </div>
</template>

<script>
export default {
    name: "Dashboard",
    data(){
        return {

        }
    },
    mounted() {

    }
}
</script>

<style scoped>

</style>
