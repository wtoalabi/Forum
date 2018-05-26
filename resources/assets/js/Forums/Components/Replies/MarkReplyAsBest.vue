<template>
<div>
    <h1 v-if="markedAsBest" class="tag is-warning mt-1"> 
        <span class="icon"><i class="fa fa-battery mr-1"></i> </span> Best Answer
    </h1>
     <div v-if="threadOwner" class="mt-1">
        <h1 class=""> 
            <a :disabled="markedAsBest" @click="mark" class="button is-small"> <span class="icon"><i class="fa fa-check mr-1"></i> </span> Mark as BEST</a>
        </h1>
    </div>
</div>
</template>

<script>
 
export default {
props:['replyID'],
mounted() {},
methods:{
    mark(){
        this.$store.dispatch('processBestReply', this.replyID)
    }
},
computed:{
    markedAsBest(){
        if(!_.isEmpty(this.$store.state.singleThread.bestReply)){
            return this.replyID == this.$store.state.singleThread.bestReply.id
        }
    },
    threadOwner(){
        return this.$store.state.loggedInUserID == this.$store.state.singleThread.owner.id
    },
    bestAnswerChosen(){

    },
    noBestAnswerYet(){
        if(this.$store.state.singleThread.hasBestReply == null){
            return true
        }
    }
}

}
 
</script>