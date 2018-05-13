import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../Store/store';
import {
    filtered,
    sort
} from './searched'

import Notifications from "../Forums/Notifications/Notifications";
import ForumsPage from "../Forums/Pages/ForumsPage";
import SingleThread from '../Forums/Pages/SingleThread';
import Threads from "../Forums/Pages/Threads";
import ThreadsCategory from '../Forums/Pages/ThreadsCategory'
import UserThreads from '../Forums/Pages/UserThreads'



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
            exact: true,
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
            path: "/threads/:category/:slug",
            name: "SingleThread",
            component: SingleThread
        },
        {
            path: "/:category_slug",
            name: "ThreadsCategory",
            component: ThreadsCategory,
            beforeEnter: (to, from, next) => {
                store.state.singleCategoryThreads = null
                return axios.get('api/category-threads/' + to.params.category_slug).then(response => {
                    store.commit("commitSingleCategoryThreads", response.data.data)
                    next()
                })

            }
        },
        {
            path: "/users/:username",
            name: "UserThreads",
            component: UserThreads,
            beforeEnter: (to, from, next) => {
                return axios.get('api/user-threads/' + to.params.username).then(response => {
                    store.commit("commitUserThreads", response.data.data)
                    next()
                })
            }
        },
        { ...filtered
        },
        { ...sort
        }
    ]
})
router.beforeEach((to, from, next) => {
    if (_.isEmpty(store.state.threads)) {
        return axios.get('api/all-threads').then(threads => {
            store.commit('commitThreads', threads.data.data);
            axios.get('api/categories').then(categories => {
                store.commit('commitCategories', categories.data.data);
            })
            next()
        })
    }
    next()

})

export default router