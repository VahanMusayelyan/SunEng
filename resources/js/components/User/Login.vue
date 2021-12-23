<template>
    <div class="vue-tempalte container">
        <form>
            <h3>Sign In</h3>

            <div class="form-group">
                <label>Email address</label>
                <input v-model="email" ref="email" type="email" class="form-control form-control-lg" required />
            </div>

            <div class="form-group">
                <label>Password</label>
                <input  v-model="password" ref="password" type="password" class="form-control form-control-lg" required />
            </div>

            <button type="button" @click.prevent="login" class="btn btn-primary btn-lg btn-block">Sign In</button>

            <p class="forgot-password text-right mt-2 mb-4">
                <router-link to="/forgot-password">Forgot password ?</router-link>
            </p>

            <div class="social-icons">
                <ul>
                    <li><a href="#"><i class="fa fa-google"></i></a></li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                </ul>
            </div>

        </form>
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
