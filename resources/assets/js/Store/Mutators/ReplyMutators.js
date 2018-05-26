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
    },
    replyDeleted(state, payload){
        if(payload.replyID == state.singleThread.bestReply.id ){
            state.singleThread.bestReply = null;
        }
        state.singleThreadReplies.data = _.reject(state.singleThreadReplies.data, function(reply){
            return reply.id === payload.replyID
        })
    },
    editedReply(state, payload){
        //console.log("mutate",payload)
        return state.singleThreadReplies.data.map(reply=>{
            if(reply.id == payload.id){
                return reply.body = payload.body
            }
        })
    },
    markAsBest(state, payload){
        return axios.post('api/reply/mark-as-best/'+payload).then(response=>{
            state.announcement = {color: 'is-primary', message: response.data.message}
            state.singleThread.bestReply = response.data.reply
        }).catch(error=>{
            state.announcement = {color: 'is-danger', message: error.response.data.message}
            
        })
    }
}