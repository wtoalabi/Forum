export default {
    commitReply(state, payload){
        return state.singleThreadReplies.data.unshift(payload)
    },
    commitSingleThreadReplies(state, payload){
        return state.singleThreadReplies = payload
    },
    loadNextRepliesFromPagination(state, payload){
        state.singleThreadReplies.data.push(...payload.data)
    },
    loadPreviousRepliesFromPagination(state, payload){
        const count = payload.data.length;
        state.singleThreadReplies.data.splice(-(count), count)
        
       // state.singleThreadReplies.data.push(...payload.data)
    }
}