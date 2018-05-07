import Threads from './ThreadsActions'
import Replies from './RepliesActions'
import LoggedInUserActions from './LoggedInUserActions'

export default {
    ...Threads,
    ...Replies,
    ...LoggedInUserActions
}