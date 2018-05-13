import SearchedThreads from '../Forums/Pages/SearchedThreads'
import store from '../Store/store';

export const filtered = {
    path: "/filter-threads/:query",
    name: "FilterThreads",
    component: SearchedThreads,
    beforeEnter: (to, from, next) => {
        return axios.get('api' + to.fullPath).then(response => {
            store.commit("commitSearchedThreads", response.data.data)
            next()
        })

    }
}

export const sort =  {
    path: "/threads/:query",
    name: "SortThreads",
    component: SearchedThreads,
    beforeEnter: (to, from, next) => {
        return axios.get('api/sort-threads/by?sort=' + to.query.by).then(response => {
            
            console.log(response.data.data)
           store.commit("commitSearchedThreads", response.data.data)
            next()
        })
    }
}