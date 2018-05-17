export default {
    getUserDetails(state, username) {
        return axios.get('api/profile/' + username).then(user => {
            //console.log(user.data)
           state.commit("addUserProfile", user.data.data)
        }).then(
        axios.get('api/activities/' + username).then(user => {
            state.commit("addUserActivities", user.data)
        }))
    }
}