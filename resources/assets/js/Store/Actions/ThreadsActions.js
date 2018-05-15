export default {
    storeAllThreads({commit}, payload) {
       // commit("commitThread", payload)
      /*  axios.get('api/all-threads', payload).then(response => {
            commit('commitThreads', response.data.data);
        }) */
    },
    getSingleThread(store, payload){
        return axios.get("api/single-thread/" + payload).then(response => {
            store.commit("commitSingleThread", response.data.data);
        }).then(
            axios.get('api/single-thread-replies/'+ payload).then(replies=>{
                store.commit("commitSingleThreadReplies", replies.data);
            })
        )
    }
}