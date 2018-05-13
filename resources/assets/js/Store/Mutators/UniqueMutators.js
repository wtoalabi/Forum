export default {

    commitCategories(state, payload){
        return state.categories =  payload
    },
    commitSingleCategoryThreads(state, payload){
        return state.singleCategoryThreads = payload
    },
    commitUserThreads(state, payload){
        return state.userThreads = payload
    },
    commitSearchedThreads(state, payload){
        return state.searchedThreads = payload
    }
}