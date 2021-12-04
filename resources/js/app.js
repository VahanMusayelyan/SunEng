require('./bootstrap');
import App from "./App.vue";
window.Vue = require('vue').default;

import router from "./router";
import common from "./common";

Vue.mixin(common);


const app = new Vue({
    el: '#app',
    components: { App },
    router
});
