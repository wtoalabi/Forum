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
    },
    commitLikeCountOfAThread(state, payload){
        return _.map(state.threads.data, thread=>{
            if(thread.id===payload){
                return thread.like_count++
            }
        })
    },
    removeLikeCountOfAThread(state, payload){
        return _.map(state.threads.data, thread=>{
            if(thread.id===payload){
                return thread.like_count--
            }
        })
    }
}