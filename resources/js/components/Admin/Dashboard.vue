<template>
    <div class="container">
        <h3>This is the Dashboard component for authenticated users</h3>
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
    mounted(){
        // checkAdmin;
        const res = this.checkAdmin()
    }
}
</script>

<style scoped>

</style>
