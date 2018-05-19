export default {
        getThreads(store, payload){
            return axios.get('api'+payload).then(response => {
                store.commit("commitThreads", response.data)
            })
        },
        getSingleThread(store, payload){
        return axios.get("api/single-thread/" + payload).then(response => {
            store.commit("commitSingleThread", response.data.data);
        })
    },
    getSingleThreadReplies(store, payload){
        return axios.get('api/single-thread-replies/'+ payload).then(replies=>{
            store.commit("commitSingleThreadReplies", replies.data);
        })
    }
}