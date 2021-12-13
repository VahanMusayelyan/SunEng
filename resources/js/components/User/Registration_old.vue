<template>
        <div class="container">
            <input v-model="name" type="name" class="form-control mt-2 mb-2" placeholder="Name">
            <input v-model="email" type="email" class="form-control mb-2" placeholder="Email">
            <input v-model="password" type="password" class="form-control mb-2" placeholder="Password">
            <input v-model="password_confirmation" type="password" class="form-control mb-2" placeholder="Confirm Password">
            <input @click="store" type="submit" class="btn btn-primary">
        </div>
</template>

<script>
export default {
    name: "Registration",
    data(){
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
        }
    },
    methods: {
        store(){
            axios.post("/api/users", {
                name :  this.name ,
                email :  this.email ,
                password :  this.password ,
                password_confirmation :  this.password_confirmation
            })
            .then(res => {
                localStorage.setItem("access_token", res.data.access_token)
                this.$router.push({name: "users.personal"})
            })
        }
    }
}
</script>

<style scoped>

</style>
