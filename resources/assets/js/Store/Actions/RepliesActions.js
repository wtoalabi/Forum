export default {
    submitReply({commit}, payload) {
        commit('commitReply', payload);
        commit("getNotifications")

    }

}