export default {
    setLoggedInUser(state, userID){
        return state.loggedInUserID = userID
    },
    setNotifications(state, payload){
        return state.notifications = payload;
    }
}