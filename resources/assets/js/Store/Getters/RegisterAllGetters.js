import UserGetters from './UserGetters'
import ThreadGetters from './ThreadGetters'
import NotificationsGetters from './NotificationsGetters'

export default {
    ...ThreadGetters,
    ...UserGetters,
    ...NotificationsGetters
}