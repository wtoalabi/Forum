export default {
    setLoggedInUser(state, user){
        return state.loggedInUser = user
    },
    setNotifications(state, payload){
        return state.notifications = payload;
    }
}