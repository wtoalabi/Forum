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
    addASingleThread(state, payload){
        state.categories.map(function(category){
            if(category.id === payload.category.id){
                return category.threads_count++
            }
        })
        return state.threads.unshift(payload)
    }

}