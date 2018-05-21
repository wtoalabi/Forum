export default {
    getUserDetails(state, username) {
        return axios.get('api/profile/' + username).then(user => {
            //console.log(user.data)
           state.commit("addUserProfile", user.data.data)
        }).then(
        axios.get('api/activities/' + username).then(user => {
            state.commit("addUserActivities", user.data)
        }))
    },
    async getNotifications(store){
        await axios.get('api/notifications').then(response=>{
            return store.commit('setNotifications', response.data)
        })
    },
    readNotification(store, id){
        return axios.delete('api/notifications/'+id).then(
            store.state.notifications.data.map((notification)=>{
                if(notification.id == id){
                    return notification.read_at = Date.now()
                }
            }),
            store.state.notifications.count.unRead --
        )
    }
}