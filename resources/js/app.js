import Vue from "vue";
import router from "./router"
import Index from "./components/Index.vue"

import common from "./common";

Vue.mixin(common);



require('./bootstrap');

const app = new Vue({
    el : "#app",
    components: {
        Index
    },
    router
})
