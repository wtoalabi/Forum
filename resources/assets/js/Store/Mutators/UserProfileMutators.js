export default {
    addUserProfile(state, payload){
        return state.userProfile = payload
    },
    addUserActivities(state, payload){
        return state.userActivities = payload
    }
}