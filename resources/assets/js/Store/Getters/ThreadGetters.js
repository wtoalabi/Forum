export default {
    getAllThreads(state) {
        return state.threads
    },
    getSingleThread(state) {
        return state.singleThread
    },
    getNewThreadForm(state) {
        return state.loadNewThreadForm
    },
    getCategories(state){
        return state.categories;
    },
    getSingleThreadReplies(state){
        return state.singleThreadReplies;
    },
    getTrendingThreads(state){
        return state.trending;
    }
}