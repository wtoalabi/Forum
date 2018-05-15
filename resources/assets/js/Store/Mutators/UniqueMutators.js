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
                thread.likes.liked = 1
                thread.likes.like_count++
                return thread
            }
        })
    },
    removeLikeCountOfAThread(state, payload){
        return _.map(state.threads.data, thread=>{
            if(thread.id===payload){
                thread.likes.liked = 0
                thread.likes.like_count--
                return thread
            }
        })
    },
    commitLikeCountOfAReply(state, payload){
        return _.map(state.singleThreadReplies.data, reply=>{
            if(reply.id===payload){
                reply.likes.liked = 1
                reply.likes.like_count++
                return reply
            }
        })
    },
    removeLikeCountOfAReply(state, payload){
        return _.map(state.singleThreadReplies.data, reply=>{
            if(reply.id===payload){
                reply.likes.liked = 0
                reply.likes.like_count--
                return reply
            }
        })
    }
}