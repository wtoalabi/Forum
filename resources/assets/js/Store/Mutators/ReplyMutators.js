export default {
    commitReply(state, payload){
        console.log("payload",payload)
        return state.singleThreadReplies.data.unshift(payload)
    },
    commitSingleThreadReplies(state, payload){
        console.log(payload)
        return state.singleThreadReplies = payload
    }
}