import ThreadGetters from './ThreadGetters'
import NotificationsGetters from './NotificationsGetters'
import LoggedInUserGetters from './LoggedInUserGetters'
import BreadcrumbsGetters from './BreadcrumbsGetters'

export default {
    ...ThreadGetters,
    ...NotificationsGetters,
    ...LoggedInUserGetters,
    ...BreadcrumbsGetters
}