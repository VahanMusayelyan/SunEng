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

            <button type="button" @click.prevent="login" class="btn btn-dark btn-lg btn-block">Sign In</button>

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
    data() {
        return {
            data : {
                device_name : "browser",
                link: "https://www.youtube.com/watch?v=M0xOzWHaoOU",
                link1: "https://www.youtube.com/watch?v=RDlc4G68IDM",
            },
            errors : {},
            email: "",
            password: "",

        }
    },
    name: 'Login',
    methods:{
        // async login(){
        //
        //     axios.get('/sanctum/csrf-cookie').then(response => {
        //         axios.post('api/auth/login', {email: this.email, password: this.password})
        //             .then(r => {
        //                 localStorage.setItem("x_xsrf_token", r.config.headers['X-XSRF-TOKEN']);
        //                 localStorage.setItem("access_token", r.data.access_token);
        //                 this.$router.push({name : "dashboard"}).catch(()=>{});
        //         })
        //         .catch(err =>{
        //             console.log(err)
        //         });
        //     });
        //
        // },
        async login(){
            alert(1)
            axios.post("/api/auth/login", {email: this.email, password: this.password}).then((response)=>{
                localStorage.setItem("x_xsrf_token", response.config.headers['X-XSRF-TOKEN'])
                localStorage.setItem("access_token", response.data.access_token);
                this.$router.push("/");
            }).catch((errors) => {
                this.errors = errors.response.data.errors
            });
        }
    }
}
</script>

<style scoped>

</style>
