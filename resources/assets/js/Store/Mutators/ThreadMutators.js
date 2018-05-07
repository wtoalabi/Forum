export default {
    commitThread(state, payload){
        //console.log("d")
        return state.users.push(payload)
    }
}