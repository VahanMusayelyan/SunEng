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
    }
}
</script>

<style scoped>
.content-dashboard{
    border: 1px solid #000000;
    border-radius: 15px;
    background-color: #f1f1f1;
    padding: 15px;
}
</style>
