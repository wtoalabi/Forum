export default {
    commitReply(state, payload){
        console.log(payload)
        return state.singleThreadReplies.push(payload)
    }
}