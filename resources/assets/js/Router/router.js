import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../Store/store';
import Notifications from "../Forums/Notifications/Notifications";
import ForumsPage from "../Forums/Pages/ForumsPage";
import SingleThread from '../Forums/Pages/SingleThread';
import Threads from "../Forums/Pages/Threads";
import UserProfile from '../Forums/Pages/UserProfile'



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
            path: "/threads/:filter?",
            name: "Threads",
            component: Threads,
            beforeEnter: (to, from, next) => {
                store.state.pageIsLoading = true
                 return axios.get('api'+to.fullPath).then(response => {
                    store.commit("commitThreads", response.data)
                    store.state.pageIsLoading = false
                    next()
                })
            }
        },
        {
            path: "/threads/:category/:slug",
            name: "SingleThread",
            component: SingleThread
        },
        {
            path: "/notifications",
            name: "Notifications",
            component: Notifications
        },
        {
            path: "/profile/:username",
            name: "UserProfile",
            component: UserProfile,
        },
    ]
})
router.beforeEach((to, from, next) => {
    if (_.isEmpty(store.state.categories)) {
        axios.get('api/categories').then(categories => {
            store.commit('commitCategories', categories.data.data);
        })
    }
    next()
})

export default router