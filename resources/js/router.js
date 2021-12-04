import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);
import Test from "./components/test.vue";
import HomePage from './components/HomePage.vue';
import Login from './components/Login.vue';
import About from './components/About.vue';
import ContactUs from "./components/ContactUs";
import Registration from "./components/Registration";
import part from "./components/part";

const routes = [
    {
        path: '/',
        component: HomePage,
        name: "home",
    },
    {
        path: "/about",
        component: About,
        name: "about",
    },
    {
        path: "/contact-us",
        component: ContactUs,
        name: "contact-us",
    },
    {
        path: '/login',
        component: Login,
        name: "login",
    },
    {
        path: '/registration',
        component: Registration,
        name: "registration",
    },
    {
        path: '/part',
        component: part,
        name: "part",
    },
];


export default new Router({
    mode: "history",
    routes,

})
