import ThreadMutators from './ThreadMutators'
import ReplyMutators from './ReplyMutators'
import LoggedInUserMutator from './LoggedInUserMutator'
import BreadcrumbsMutator from './BreadcrumbsMutator'
import UniqueMutators from './UniqueMutators'
import UserProfileMutators from './UserProfileMutators'



export default {
    ...UserProfileMutators,
    ...UniqueMutators,
    ...ThreadMutators,
    ...ReplyMutators,
    ...LoggedInUserMutator,
    ...BreadcrumbsMutator
}