import ThreadMutators from './ThreadMutators'
import ReplyMutators from './ReplyMutators'
import LoggedInUserMutator from './LoggedInUserMutator'
import BreadcrumbsMutator from './BreadcrumbsMutator'
import UniqueMutators from './UniqueMutators'



export default {
    ...UniqueMutators,
    ...ThreadMutators,
    ...ReplyMutators,
    ...LoggedInUserMutator,
    ...BreadcrumbsMutator
}