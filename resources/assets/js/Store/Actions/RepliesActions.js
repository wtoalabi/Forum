export default {
    submitReply({commit}, payload) {
        commit('commitReply', payload);
        commit("getNotifications")

    },
    processBestReply({commit}, payload){
        commit('markAsBest', payload)
    }

}