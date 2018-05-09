import ThreadMutators from './ThreadMutators'
import ReplyMutators from './ReplyMutators'
import LoggedInUserMutator from './LoggedInUserMutator'

export default {
    ...ThreadMutators,
    ...ReplyMutators,
    ...LoggedInUserMutator
}