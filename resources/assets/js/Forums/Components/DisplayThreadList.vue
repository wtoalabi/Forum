<template>
<div class="column is-12">
    <h2 class="title is-3">{{pageName}}</h2>
    <div class="" v-for="thread in threads" :key="thread.id">
        <div class="box content is-small">
            <div class="columns">
                <div class="column">
                    <h1 class="">
                        <span v-if="thread.updatedSinceLastVisit" class="tag is-primary has-text-white"> <i class="fa fa-lightbulb-o"></i></span>
                        <router-link :to="'/threads/' + thread.category.slug + '/' + thread.slug " exact><span>{{thread.title}}</span></router-link></h1>
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
                        <div class="column is-offset-4">
                            <delete
                                :id="thread.user.id"
                                :url="'api/delete-thread/'+thread.id"
                                mutator="threadDeleted"
                                name="Thread"
                                redirectedPath="/threads">
                            </delete>
                        </div>
                    </div>
                </div>
            </div>
            <small>Posted in  <router-link :to="'/threads/query?filterCategory='+ thread.category.slug">{{thread.category.name}}</router-link> || {{thread.created_at}} ||Replies:{{thread.replies_count}} || <router-link :to="'/profile/' + thread.user.username"><span>{{thread.user.name}}</span></router-link></small> Visits:{{thread.visits}}

            <h2>{{thread.body | readMore}}</h2>
        </div>
    </div>
</div>
</template>

<script>
 
export default {
props:['threads'],
mounted() {  
//console.log(this.$route.params.filter);
console.log(this.$route.query);


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
    },
    pageName(){
        if(this.$route.query.filterCategory){
            return _.first(this.threads).category.name + " threads..."
        }
        else if(this.$route.query.sortByPopular){
            return "Popular Threads"
        }
        else if(this.$route.query.sortByUser){
            return _.first(this.threads).user.name + " threads..."
        }
    }
  }

}
 
</script>