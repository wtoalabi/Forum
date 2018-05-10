import ThreadsState from './ThreadsState'
import Notifications from './Notifications'
import LoggedInUser from './LoggedInUser'
import Breadcrumbs from './Breadcrumbs'

export default {
    ...ThreadsState,
    ...Notifications,
    ...LoggedInUser,
    ...Breadcrumbs
}