export default {
    storeLoggedInUser({commit}, userID){
        return commit("setLoggedInUser",userID)
        /* axios('api/user/' + payload).then(response=>{
        }).catch(error=>{
            if(error.response.statusText == "Unauthorized"){
                return this.state.loggedInUser.username = "Guest User"
            }
            else{
                this.state.loggedInUser.username = error.response.statusText
            }
        }) */
    }
}