import ThreadMutators from './ThreadMutators'
import ReplyMutators from './ReplyMutators'
import LoggedInUserMutator from './LoggedInUserMutator'
import BreadcrumbsMutator from './BreadcrumbsMutator'

export default {
    ...ThreadMutators,
    ...ReplyMutators,
    ...LoggedInUserMutator,
    ...BreadcrumbsMutator
}