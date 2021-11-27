require('./bootstrap');
import App from "./App.vue";
window.Vue = require('vue').default;

import router from "./router";
import common from "./common";

Vue.mixin(common);

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)

// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)


const app = new Vue({
    el: '#app',
    components: { App },
    router
});
