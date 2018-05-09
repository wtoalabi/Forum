import Vue from 'vue';
import VueRouter from 'vue-router'
import ForumsPage from "./Forums/Pages/ForumsPage"
import Threads from "./Forums/Pages/Threads"
import Notifications from "./Forums/Notifications/Notifications"
import SingleThread from './Forums/Pages/SingleThread'


Vue.use(VueRouter)

export default new VueRouter({
    mode: "hash",
    linkExactActiveClass: "active-forum-menu",
    routes: [
        {
            path: "/",
            name: "ForumsPage",
            component: ForumsPage
        },
        {
            path: "/threads",
            name: "Threads",
            component: Threads
        },
        {
            path: "/notifications",
            name: "Notifications",
            component: Notifications
        },
        {
            path: "/thread/:slug",
            name: "SingleThread",
            component: SingleThread
        }
    ]
})