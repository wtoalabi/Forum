export default {
    storeLoggedInUser({commit}, userID){
        return commit("setLoggedInUser",userID)
    }
}