export default {
    getUserProfile(state, username) {
        return axios.get('api/profile/' + username).then(user => {
            state.commit("addUserProfile", user.data.data)
        })
    }
}