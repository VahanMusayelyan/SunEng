<template>
    <div>
        <div class="w-50">
            <label for="email">Email</label>
            <input v-model="email" type="email" class="form-control mt-2 mb-2">
            <label for="password">Password</label>
            <input v-model="password" type="password" class="form-control mb-2">
            <input type="submit" @click="login" class="btn btn-primary">
            <div class="text-danger" v-if="error">{{this.error}}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    data(){
        return {
            email: null,
            password : null,
            error: null
        }
    },
    methods : {
        login() {
            axios.post("/api/auth/login", {email: this.email, password: this.password})
            .then(res => {
                localStorage.setItem("access_token", res.data.access_token)
                this.$router.push("/users/personal");

            }).catch(error => {
                console.log(error.response)
                this.error = error.response.data.error;
            })
        }
    }
}
</script>

<style scoped>

</style>
