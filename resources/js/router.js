import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);
import FirstPage from "./components/myfirstvuepage.vue";
import Test from "./components/test.vue";
import HomePage from './components/HomePage.vue';
import Login from './components/Login.vue';
import Methods from './components/methods.vue';

const routes = [
    {
        path: '/',
        component: HomePage
    },
    {
        path: "/my",
        component: FirstPage,
    },
    {
        path: "/test",
        component: Test,
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/methods',
        component: Methods
    },
];


export default new Router({
    mode: "history",
    routes,

})
