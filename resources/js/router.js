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
import Courses from "./components/Admin/Courses/Courses";
import StudentsIndex from "./components/Admin/Students/StudentsIndex";
import TeachersIndex from "./components/Admin/Teachers/TeachersIndex";
import CourseIndex from './components/Admin/Course/CourseIndex'

import Lessons from './components/Admin/Lessons/Index'
import Lesson from './components/Admin/Lessons/Show'
import SlideIndex from "./components/Admin/SlidesHomeworks/SlideIndex";
import HomeworkIndex from "./components/Admin/SlidesHomeworks/HomeworkIndex";

import LessonSlideContent from "./components/Admin/Lessons/LessonSlideContent";
import SlideShow from "./components/Admin/SlidesHomeworks/SlideShow";
import HomeworkShow from './components/Admin/SlidesHomeworks/HomeworkShow'

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
        // courses
        {
            path: '/dashboard',
            component: Dashboard,
            name: "dashboard",
        },
        {
            path: '/dashboard/courses',
            component: Courses,
            name: "dashboard.courses",
        },
        {
            path: '/dashboard/course/:id',
            component: CourseIndex,
            name: "dashboard.course",
        },
        // lessons
        {
            path: '/dashboard/lessons',
            component: Lessons,
            name: "lessons.index",
        },
        {
            path: '/dashboard/lesson/:id',
            component: Lesson,
            name: "lesson",
        },
        // works-slides
        {
            path: '/dashboard/slides',
            component: SlideIndex,
            name: "slides.index",
        },
        {
            path: '/dashboard/homeworks',
            component: HomeworkIndex,
            name: "homeworks.index",
        },

        //lessons slides content
        {
            path: '/dashboard/slide/:id',
            component: SlideShow,
            name: "slide.show",
        }
        ,{
            path: '/dashboard/lesson-slide/:id',
            component: LessonSlideContent,
            name: "lesson.slide.content",
        },
        //lessons homeworks content
        {
            path: '/dashboard/lesson-homework/:id',
            component: HomeworkShow,
            name: "lesson.homework.content",
        },


        // other route
        {
            path: '/dashboard/students',
            component: StudentsIndex,
            name: "dashboard.students",
        },
        {
            path: '/dashboard/teachers',
            component: TeachersIndex,
            name: "dashboard.teachers",
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
