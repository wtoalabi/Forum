import SearchedThreads from '../Forums/Pages/SearchedThreads'
import store from '../Store/store';

export const filtered = {
    path: "/filter-threads/:query",
    name: "FilterThreads",
    component: SearchedThreads,
    beforeEnter: (to, from, next) => {
        if (_.isEmpty(store.state.searchedThreads)) {
            store.state.pageIsLoading = true
            return axios.get('api' + to.fullPath).then(response => {
                store.commit("commitSearchedThreads", response.data)
                next()
                store.state.pageIsLoading = false
            })
        }
        next()
    }
}

export const sort = {
    path: "/threads/:query",
    name: "SortThreads",
    component: SearchedThreads,
    beforeEnter: (to, from, next) => {
        if (_.isEmpty(store.state.searchedThreads)) {
            store.state.pageIsLoading = true
            return axios.get('api/sort-threads/by?sort=' + to.query.by).then(response => {
                store.commit("commitSearchedThreads", response.data)
                next()
                store.state.pageIsLoading = false
            })
        }
        next()
    }
}