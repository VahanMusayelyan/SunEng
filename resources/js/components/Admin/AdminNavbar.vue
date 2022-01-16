<template>
    <div style="" class="d-inline-block menu-admin">
        <div class="d-inline-block">
            <router-link :to="{name: 'dashboard'}">
                <img class="brand-logo-dark ml-auto mr-auto d-block mb-2" id="logo_menu"
                     src="/images/logo.svg" alt="" width="195"
                     height="39"/></router-link>
            <nav class="nav flex-column">
                <router-link class="nav-link" :to="{name:'dashboard.courses'}">Courses</router-link>
                <router-link class="nav-link" :to="{name:'lessons.index'}">Lessons</router-link>
                <router-link class="nav-link" :to="{name:'slides.index'}">Slides</router-link>
                <router-link class="nav-link" :to="{name:'homeworks.index'}">Homeworks</router-link>
                <router-link class="nav-link" :to="{name:'dashboard.teachers'}">Teachers</router-link>
                <router-link class="nav-link" :to="{name:'dashboard.students'}">Students</router-link>
                <a class="cursor-pointer" @click.prevent="logout">Logout</a>
            </nav>
        </div>
    </div>
</template>

<script>
import API from "../../api";

export default {
    name: "AdminNavbar",
    data() {
        return {}
    },
    methods: {
        logout() {
            API.post("/api/auth/logout")
                .then(res => {
                    localStorage.removeItem("access_token")
                    this.$router.push({name: "users.login"})
                })
        },
    }
}
</script>

<style scoped>
.menu-admin {
    background-color: #000000;
    width: 11%;
    margin: 0 2%;
    border-radius: 15px;
    padding: 10px;
}
</style>
