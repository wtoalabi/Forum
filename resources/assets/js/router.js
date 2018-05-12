import Vue from 'vue';
import VueRouter from 'vue-router'
import ForumsPage from "./Forums/Pages/ForumsPage"
import Threads from "./Forums/Pages/Threads"
import Notifications from "./Forums/Notifications/Notifications"
import SingleThread from './Forums/Pages/SingleThread'
import store from './Store/store'


Vue.use(VueRouter)

let router = new VueRouter({
    mode: "hash",
    linkExactActiveClass: "active-forum-menu",
    routes: [{
            path: "/",
            name: "ForumsPage",
            component: ForumsPage
        },
        {
            path: "/threads",
            name: "Threads",
            component: Threads,
        },
        {
            path: "/notifications",
            name: "Notifications",
            component: Notifications
        },
        {
            path: "/threads/:slug",
            name: "SingleThread",
            component: SingleThread
        }
    ]
})
router.beforeEach((to, from, next) => {
    if (_.isEmpty(store.state.threads)) {
        return axios.get('api/all-threads').then(threads => {
            store.commit('commitThreads', threads.data.data);
            axios.get('api/categories').then(categories =>{
                store.commit('commitCategories', categories.data.data);
            })
            next()
        })
    }
    next()

})

export default router