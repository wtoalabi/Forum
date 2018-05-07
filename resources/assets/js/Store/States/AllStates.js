import ThreadsState from './ThreadsState'
import Notifications from './Notifications'
import LoggedInUser from './LoggedInUser'

export default {
    ...ThreadsState,
    ...Notifications,
    ...LoggedInUser
}