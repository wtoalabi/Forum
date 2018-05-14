import ThreadsState from './ThreadsState'
import Notifications from './Notifications'
import LoggedInUser from './LoggedInUser'
import Breadcrumbs from './Breadcrumbs'
import Categories from './Categories'

export default {
    ...ThreadsState,
    ...Categories,
    ...Notifications,
    ...LoggedInUser,
    ...Breadcrumbs,
    pageIsLoading: false
}