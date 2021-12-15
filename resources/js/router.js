import Vue from 'vue';
import VueRouter from "vue-router";
import FruitIndex from "./components/Fruit";
import Login from "./components/User/Login";
import Registration from "./components/User/Registration";
import HomePage from "./components/HomePage";
import About from "./components/About";
import ContactUs from "./components/ContactUs";
import NotFount from "./components/NotFount";
import Personal from "./components/User/Personal";


import Dashboard from "./components/Admin/Dashboard";

Vue.use(VueRouter);


const route = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: "/fruits",
            component: FruitIndex,
            name: "fruit.index"
        },
        {
            path: "/users/registration",
            component: Registration,
            name: "users.registration"
        },
        {
            path: "/users/login",
            component: Login,
            name: "users.login"
        },
        {
            path: "/users/personal",
            component: Personal,
            name: "users.personal"
        },
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
            path: '/dashboard',
            component: Dashboard,
            name: "dashboard",
        },
        {
            path: '*',
            component: NotFount,
            name: "404",
        }
    ]
})


route.beforeEach((to, from, next) => {

    const access_token = localStorage.getItem("access_token");
    if (!access_token) {
        if (to.name === "users.login" || to.name === "users.registration" || to.name === "home") {
            return next();
        } else {
            if (!access_token) {
                return next({
                    name: "users.login"
                })
            }
        }
    }


    if (to.name === "users.login" || to.name === "users.registration" && access_token) {
        return next({
            name: "users.personal"
        });
    }

    next();

})

export default route
