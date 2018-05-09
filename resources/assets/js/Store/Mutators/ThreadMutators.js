export default {
    commitThreads(state, payload){
        return state.threads = payload
    },
    commitSingleThread(state, payload){
        return state.singleThread = payload
    }
}