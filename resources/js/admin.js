import Vue from "vue";
import router from "./router"
import adminapp from "./components/Admin/AdminApp.vue"

import common from "./common";

Vue.mixin(common);



require('./bootstrap');

const app = new Vue({
    el : "#admin",
    components: {
        adminapp
    },
    router
})
