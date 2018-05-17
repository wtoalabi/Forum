<template>
<div>
    <div class="content">
            <div  class="columns is-centered" v-for="reply in replies.data" :key="reply.id">
                <div class="column is-9 mt-1">
                    <div class="columns notification is-primary">
                        <div class="column is-3">
                            <span class="title is-5">{{reply.user}}</span>
                            <p><em class="em">{{reply.created_at}}</em></p>
                             <delete
                                :url="'api/delete-reply/'+reply.id"
                                mutator="replyDeleted"
                                name="Reply"
                                :redirectedPath="fullPath">
                            </delete>
                        </div>
                        <div class="column has-text-black message is-primary">
                                {{reply.body}}
                        </div>
                        <div class="column is-1 is-offset-1">
                            <like 
                                    :count="reply.likes.like_count"
                                    :liked="reply.likes.liked"
                                    :ID="reply.id"
                                    url='api/like-reply/'
                                    addCountMutator="commitLikeCountOfAReply"
                                    removeCountMutator = "removeLikeCountOfAReply">
                            </like>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <pagination 
                :mainData="replies"
                nextPageCommitMessage="loadNextRepliesFromPagination"
                previousPageCommitMessage="loadPreviousRepliesFromPagination"
                paginationText="Replies">
            </pagination>
        </div>
</template>

<style>

</style>

<script>
export default {
mounted() {   
    //console.log();
     
},
data(){
    return{
    }
},
methods:{
},
computed:{
    replies(){
        return this.$store.getters.getSingleThreadReplies
    },
    fullPath(){
        return this.$route.fullPath
    }
}

}
 
</script>