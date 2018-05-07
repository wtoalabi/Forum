export default {
    submitThread({commit}, payload) {
        commit("commitThread", payload)
        //return commit('commitThread', payload)
       /*  axios.post('create-thread', payload).then(response => {
            commit('commitThread', response.data);
        }) */
    }
}