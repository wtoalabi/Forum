import ThreadGetters from './ThreadGetters'
import NotificationsGetters from './NotificationsGetters'
import LoggedInUserGetters from './LoggedInUserGetters'

export default {
    ...ThreadGetters,
    ...NotificationsGetters,
    ...LoggedInUserGetters
}