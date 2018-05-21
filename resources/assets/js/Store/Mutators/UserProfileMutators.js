export default {
    addUserProfile(state, payload){
        return state.userProfile = payload
    },
    addUserActivities(state, payload){
        return state.userActivities = payload
    },
    markANotificationAsRead(state, id){
        state.notifications.data.map((notification)=>{
            if(notification.id == id){
                return notification.read_at = Date.now()
            }
        })
        if(state.notifications.count.unRead > 0){
            state.notifications.count.unRead --
        }
    },
    getNotifications(state){
        return axios.get('api/notifications').then(response=>{
            state.notifications = response.data
        })
    }
}