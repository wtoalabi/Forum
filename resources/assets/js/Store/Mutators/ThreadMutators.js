export default {
    commitThreads(state, payload) {
        return state.threads = payload
    },
    commitSingleThread(state, payload) {
        return state.singleThread = payload
    },
    loadNewThreadForm(state) {
        return state.loadNewThreadForm = true
    },
    closeThreadForm(state) {
        return state.loadNewThreadForm = false
    },

}