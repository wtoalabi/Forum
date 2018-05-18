import ThreadsState from './ThreadsState'
import Notifications from './Notifications'
import LoggedInUser from './LoggedInUser'
import Breadcrumbs from './Breadcrumbs'
import Categories from './Categories'
import UserProfile from './UserProfile'


export default {
    ...UserProfile,
    ...ThreadsState,
    ...Categories,
    ...Notifications,
    ...LoggedInUser,
    ...Breadcrumbs,
    pageIsLoading: false,
    announcement: {message: '',color:'is-warning'}
}