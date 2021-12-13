<template>
    <div>
        <div class="preloader" id="preloader">
            <div class="preloader-inner">
                <div class="preloader-top">
                    <div class="preloader-top-sun">
                        <div class="preloader-top-sun-bg"></div>
                        <div class="preloader-top-sun-line preloader-top-sun-line-0"></div>
                        <div class="preloader-top-sun-line preloader-top-sun-line-45"></div>
                        <div class="preloader-top-sun-line preloader-top-sun-line-90"></div>
                        <div class="preloader-top-sun-line preloader-top-sun-line-135"></div>
                        <div class="preloader-top-sun-line preloader-top-sun-line-180"></div>
                        <div class="preloader-top-sun-line preloader-top-sun-line-225"></div>
                        <div class="preloader-top-sun-line preloader-top-sun-line-270"></div>
                        <div class="preloader-top-sun-line preloader-top-sun-line-315"></div>
                    </div>
                </div>
                <div class="preloader-bottom">
                    <div class="preloader-bottom-line preloader-bottom-line-lg"></div>
                    <div class="preloader-bottom-line preloader-bottom-line-md"></div>
                    <div class="preloader-bottom-line preloader-bottom-line-sm"></div>
                    <div class="preloader-bottom-line preloader-bottom-line-xs"></div>
                </div>
            </div>
        </div>
        <div class="rd-navbar-wrap">
            <div class="rd-navbar-main-outer">
                <div class="rd-navbar-main">
                    <!-- RD Navbar Panel-->
                    <div class="rd-navbar-panel">
                        <!-- RD Navbar Toggle-->
                        <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span>
                        </button>
                        <!-- RD Navbar Brand-->
                        <div class="rd-navbar-brand">
                            <router-link class="brand" to="/"><img class="brand-logo-dark" id="logo_menu"
                                                                   src="/images/logo.svg" alt="" width="195"
                                                                   height="39"/><img class="brand-logo-light"
                                                                                     src="images/logo-inverse-195x39.png"
                                                                                     alt="" width="195" height="39"/>
                            </router-link>
                        </div>
                    </div>
                    <div class="rd-navbar-nav-wrap">
                        <!-- RD Navbar Nav-->
                        <ul class="rd-navbar-nav">
                            <li class="rd-nav-item">
                                <router-link class="rd-nav-link" to="/">Home</router-link>
                            </li>
                            <li class="rd-nav-item active">
                                <router-link class="rd-nav-link" to="/about">About</router-link>
                            </li>
                            <li class="rd-nav-item">
                                <router-link class="rd-nav-link" to="/typography">Typography</router-link>
                            </li>
                            <li class="rd-nav-item">
                                <router-link class="rd-nav-link" to="/contact-us">Contact us</router-link>
                            </li>
                            <li class="rd-nav-item">
                                <router-link class="rd-nav-link" to="/part">Particlar</router-link>
                            </li>
                            <li v-if="token" class="rd-nav-item">
                                <router-link class="rd-nav-link" to="/dashboard">Dashboard</router-link>
                            </li>
                        </ul>
                        <ul class="rd-navbar-nav login-registr">
                            <li v-if="!token" class="rd-nav-item">
                                <router-link class="rd-nav-link" to="/login">Login</router-link>
                            </li>
                            <li v-if="!token" class="rd-nav-item active">
                                <router-link class="rd-nav-link" to="/registration">Registration</router-link>
                            </li>
                            <li v-if="token" class="rd-nav-item active">
                                <a class="rd-nav-link" @click="logout()">Logout</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="rd-navbar-placeholder"></div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            duration: 1000,
            token: null,
        }
    },
    methods: {
        preloader() {
            let preloader = document.getElementById("preloader")

            // setTimeout(function () {
                preloader.classList.add('loaded');
            // }, this.duration * .75);
        },
        logout(){
           axios.post("/logout").then(res => {
               localStorage.removeItem("x_xsrf_token");
               localStorage.removeItem("access_token");
               this.$router.push({name : "login"})
           })
        },
        getToken(){
            this.token = localStorage.getItem("x_xsrf_token");
        }
    },
    mounted() {
        this.preloader();
        this.getToken();

    },
    updated() {
        this.getToken();
    }
}
</script>

<style scoped>


</style>
