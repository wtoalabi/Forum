<template>
<div>
   <div>
        <div class="column is-10 is-offset-1">
            <div class="content is-large"><h1>{{thread.title}}</h1>
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
            </div>
        </div>
        <hr/>
        <div></div>
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
        store.state.pageIsLoading = false
        next()
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
            return this.$store.getters.getSingleThread
        }
    }
}
</script>