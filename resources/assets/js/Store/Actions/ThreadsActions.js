export default {
    storeAllThreads({commit}, payload) {
       // commit("commitThread", payload)
       axios.get('api/all-threads', payload).then(response => {
            commit('commitThreads', response.data.data);
        })
    }
}