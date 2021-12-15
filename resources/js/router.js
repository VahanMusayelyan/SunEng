import Vue from 'vue';
import VueRouter from "vue-router";
import Login from "./components/User/Login";
import Registration from "./components/User/Registration";
import HomePage from "./components/HomePage";
import About from "./components/About";
import ContactUs from "./components/ContactUs";
import NotFound from "./components/NotFound";
import Typography from "./components/Typography";
import Profile from "./components/User/Profile";



import Dashboard from "./components/Admin/Dashboard";
import FruitIndex from "./components/Fruit";
import Personal from "./components/User/Personal";
import Categories from "./components/Admin/Categories/Categories";

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
            path: '/profile',
            component: Profile,
            name: "profile",
        },
        {
            path: '/typography',
            component: Typography,
            name: "typography",
        },

        //Admin routes start
        {
            path: '/dashboard/categories',
            component: Categories,
            name: "dashboard.categories",
        },
        {
            path: '/dashboard',
            component: Dashboard,
            name: "dashboard",
        },



        {
            path: '*',
            component: NotFound,
            name: "404",
        },
    ]
})


route.beforeEach((to, from, next) => {

    const access_token = localStorage.getItem("access_token");
    if (!access_token) {
        if (
            to.name === "users.login" ||
            to.name === "users.registration" ||
            to.name === "home" ||
            to.name === "about" ||
            to.name === "contact-us" ||
            to.name === "typography"
        ) {
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
