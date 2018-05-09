export default {
    storeUser({commit}, payload){
        axios('api/user/' + payload).then(response=>{
            commit("setLoggedInUser", response.data.data)
        }).catch(error=>{
            if(error.response.statusText == "Unauthorized"){
                return this.state.loggedInUser.username = "Guest User"
            }
            else{
                this.state.loggedInUser.username = error.response.statusText
            }
        })
    }
}