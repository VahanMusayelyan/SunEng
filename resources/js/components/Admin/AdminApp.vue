<template>
    <div id="navbar">
        <AdminNavbar />
        <router-view />
    </div>
</template>

<script>
import AdminIndex from "./AdminIndex"
import AdminNavbar from "./AdminNavbar";

export default {
    name: 'adminapp',
    data(){
        return{

        }
    },
    components: {
        AdminNavbar,
        AdminIndex
    },
    mounted() {
        const res = this.checkAdmin()
    }
}
</script>

<style>
#navbar{
    display: flex;
}
</style>
