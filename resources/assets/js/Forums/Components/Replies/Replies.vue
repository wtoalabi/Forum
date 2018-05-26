<template>
<div>
    <div class="content">
        <div v-if="bestReply" class="columns is-centered">
            <div class="column is-10 mt-1 has-text-black notification is-warning">
                <div class="content">
                    <div class="has-text-centered title is-4">Best Answer!</div>
                    <blockquote>"<span v-html="bestReply.body" class=""></span>"
                        <p class="title is-6">{{bestReply.user}}</p>
                    </blockquote>
                </div>
            </div>
        </div>
        <div  class="columns is-centered" v-for="reply in replies.data" :key="reply.id">
                <div class="column is-10 mt-1">
                    <div class="columns notification is-primary">
                        <div class="column is-3">
                            <span class="title is-5">{{reply.user}}</span>
                            <p><em class="em">{{reply.created_at}}</em></p>
                            <delete
                                :id="reply.user_id"
                                :url="'api/delete-reply/'+reply.id"
                                mutator="replyDeleted"
                                name="Reply"
                                :redirectedPath="fullPath">
                            </delete>
                            <edit class="mt-2"
                                :id="reply.user_id"
                                :content="reply"
                                editComponent="editreply">

                            </edit>
                        </div>
                        <div class="column has-text-black message is-primary">
                                <span v-html="reply.body" class=""></span>
                        </div>
                        <div class="column is-2">
                            <div>
                                <like 
                                    :count="reply.likes.like_count"
                                    :liked="reply.likes.liked"
                                    :ID="reply.id"
                                    url='api/like-reply/'
                                    addCountMutator="commitLikeCountOfAReply"
                                    removeCountMutator = "removeLikeCountOfAReply">
                                </like>
                            </div>  
                                <mark-reply
                                    :replyID="reply.id">
                                </mark-reply>
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
    },
    bestReply(){
        return this.$store.state.singleThread.bestReply
    }
}

}
 
</script>