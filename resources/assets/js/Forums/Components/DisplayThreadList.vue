<template>
<div>
    <div class="column is-12" v-for="thread in threads" :key="thread.id">
        <div class="box content is-small">
            <div class="columns">
                <div class="column">
                    <h1 class=""><router-link :to="'/threads/' + thread.category.slug + '/' + thread.slug " exact><span>{{thread.title}}</span></router-link></h1>
                </div>
                <div class="column is-3">
                    <div class="columns">
                        <div class="column is-3">
                            <like 
                                :count="thread.likes.like_count"
                                :liked="thread.likes.liked"
                                :threadID="thread.id"
                                url='api/like-thread/'
                                :ID="thread.id"
                                addCountMutator="commitLikeCountOfAThread"
                                removeCountMutator = "removeLikeCountOfAThread">
                            </like>
                        </div>
                        <div v-if="owner == thread.user.user_id" class="column is-offset-4">
                            <delete
                            :url="'api/delete-thread/'+thread.id"
                            mutator="threadDeleted"
                            name="Thread"
                            redirectedPath="/threads">

                            </delete>
                        </div>
                    </div>
                </div>
            </div>
            <small>Posted in  {{thread.category.name}} || {{thread.created_at}} ||Replies:{{thread.replies_count}} || <router-link :to="'/profile/' + thread.user.username"><span>{{thread.user.name}}</span></router-link></small>
            <h2>{{thread.body | readMore}}</h2>
        </div>
    </div>
</div>
</template>

<script>
 
export default {
props:['threads'],
mounted() {
    console.log(this.owner);
    

},
methods:{
    
},
filters: {
    readMore(text) {
      return _.truncate(text, { length: 100 });
    }
  },
  data(){
      return{
    
      }
  },
  computed:{
    owner(){
        return this.$store.state.loggedInUserID
    }
  }

}
 
</script>