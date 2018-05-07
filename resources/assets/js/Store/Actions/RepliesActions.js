export default {
    submitReply({commit}, payload) {
        axios.post('create-reply', payload).then(response => {
            commit('commitReply', response.data);
        })
    }
}