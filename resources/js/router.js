import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);
import Dashboard from "./components/dashboard.vue";
import HomePage from './components/HomePage.vue';
import Login from './components/Login.vue';
import About from './components/About.vue';
import ContactUs from "./components/ContactUs";
import Registration from "./components/Registration";
import part from "./components/part";

const router = new Router({
    mode: "history",
    routes: [
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
        {
            path: '/dashboard',
            component: Dashboard,
            name: "dashboard",
        }
    ]

})


router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("x_xsrf_token");

    if (!token) {
        if (to.name === "login" || to.name === "registration") {
            return next()
        } else if (
            to.name === "home" ||
            to.name === "about" ||
            to.name === "contact-us" ||
            to.name === "part"
        ) {
            return next()
        } else {
            return next({
                name: "login"
            })
        }
    }

    if (to.name == "login" || to.name == "registration" && token) {
        return next({
            name: "dashboard"
        })
    }

    next()

});

export default router;
