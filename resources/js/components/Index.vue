<template>
        <div class="container">
           <router-link class="m-2" :to="{name : 'fruit.index'}">List</router-link>
           <router-link class="m-2" v-if="!accessToken" :to="{name : 'users.login'}">Login</router-link>
           <router-link class="m-2" v-if="!accessToken" :to="{name : 'users.registration'}">Registration</router-link>
           <router-link class="m-2" v-if="accessToken" :to="{name : 'users.personal'}">Personal</router-link>
           <a class="m-2" v-if="accessToken" @click.prevent="logout">Logout</a>
           <router-view></router-view>
        </div>
</template>

<script>
import API from "../api"
export default {
    name: "Index",
    data(){
        return {
            accessToken : null
        }
    },
    mounted(){
        this.getAccessToken()
    },
    methods: {
        getAccessToken (){
            this.accessToken = localStorage.getItem("access_token")
        },
        logout(){
            API.post("/api/auth/logout")
            .then(res => {
                localStorage.removeItem("access_token")
                this.$router.push({name: "users.login"})
            })
        }
    },
    updated() {
        this.getAccessToken()
    }
}
</script>

<style scoped>

</style>
