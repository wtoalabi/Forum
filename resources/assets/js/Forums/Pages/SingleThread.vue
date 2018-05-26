<template>
<div>
   <div>
        <div class="column is-10 is-offset-1">
            <div class="content is-large"><h1>{{thread.title}}</h1>

            <div class="column is-offset-4">
                <delete
                    :id="thread.owner.id"
                    :url="'api/delete-thread/'+thread.id"
                    mutator="threadDeleted"
                    name="Thread"
                    redirectedPath="/threads">
                </delete>
                <div v-if="isAdmin">
                    <lock-thread></lock-thread>
                </div>
            </div>
            <hr/>
            <div class="columns">
                <div class="column is-5">
                    <em> {{thread.owner.name}}</em>
                    <p><a :href="thread.category.slug"><small>{{thread.category.name}} <span class="is-rounded is-small tag is-primary">{{thread.category.threads_count}}</span></small></a></p>
                </div>
                <div class="column is-4 is-offset-3">
                    <em>{{thread.created_at}}</em>
                </div>
            </div>
            <hr/>
            <p>{{thread.body}}</p>
            <subscription></subscription>
            </div>
        </div>
        <div class="notification is-warning column is-10 is-offset-1" v-if="isLocked">
            Thread is LOCKED to New replies...
        </div>
        <hr/>
            <newreply></newreply>
        </div>
</div>
</template>

<script>
import store from '../../Store/store'
export default {
    async beforeRouteEnter(to, from, next){
        store.state.pageIsLoading = true
        await store.dispatch("getSingleThread", to.params.slug)
        await store.dispatch("getSingleThreadReplies", to.params.slug)

        store.state.pageIsLoading = false
        next()
    },
    watch:{
        async '$route'(to, from){
            this.$store.state.pageIsLoading = true
            await store.dispatch("getSingleThread", to.params.slug)
            await store.dispatch("getSingleThreadReplies", to.params.slug)
            this.$store.state.pageIsLoading = false
          
      }
  },
    mounted(){
    },
    data() {
        return {
            error: null
        };
  },
  methods:{
      
  },
    computed:{
        thread(){
            return this.$store.state.singleThread
        },
         owner(){
            return this.$store.state.loggedInUser.id
        },
        isAdmin(){
            return this.$store.state.loggedInUser.isAdmin
        },
        isLocked(){
            return this.$store.state.singleThread.isLocked == true
        }
        
    }
}
</script>