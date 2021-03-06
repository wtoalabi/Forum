Vue.component('spinner', require('vue-simple-spinner'));
Vue.component('dashboard', require('./Pages/Dashboard.vue'));
Vue.component('forum-home', require('./Forums/HomeLinks.vue'));
Vue.component('mast', require('./Forums/Components/ForumMast'));
Vue.component('newthread', require('./Forums/Components/CreateNewThread'));
Vue.component('threadslist', require('./Forums/Components/DisplayThreadList'));
Vue.component('pagination', require('./Forums/Components/Pagination'));
Vue.component('like', require('./Forums/Components/LikeComponent'));
Vue.component('delete', require('./Forums/Components/DeleteComponent'));
Vue.component('announcement', require('./Forums/Components/Announcement'));
Vue.component('activities', require('./Forums/Components/Activities'));
Vue.component('edit', require('./Forums/Components/EditButton'));
Vue.component('subscription', require('./Forums/Components/SubscriptionsButton'));
Vue.component('notifications-count', require('./Forums/Components/NotificationsCount'));
Vue.component('lock-thread', require('./Forums/Components/LockThread'));
/* Replies */
Vue.component('replies', require('./Forums/Components/Replies/Replies'));
Vue.component('newreply', require('./Forums/Components/Replies/CreateNewReply'));
Vue.component('editreply', require('./Forums/Components/Replies/EditReply'));
Vue.component('mark-reply', require('./Forums/Components/Replies/MarkReplyAsBest'));

