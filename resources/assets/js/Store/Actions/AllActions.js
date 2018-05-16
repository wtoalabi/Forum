import Threads from './ThreadsActions'
import Replies from './RepliesActions'
import User from './UserActions'

import LoggedInUserActions from './LoggedInUserActions'

export default {
    ...User,
    ...Threads,
    ...Replies,
    ...LoggedInUserActions
}