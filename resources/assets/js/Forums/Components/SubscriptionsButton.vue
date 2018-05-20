<template>
<div>
    <div class="button" :class="{'is-primary' : subscribed}" @click="clicked">{{subscribeText}}</div>
</div>
</template>

<script>
 
export default {
 
mounted() {

},
data(){
    return{
        subscribed: this.$store.state.singleThread.subscribedTo,
        threadID: this.$store.state.singleThread.id
    }
},
methods:{
    clicked(){
        axios[(this.subscribed ? 'delete' : 'post')]('api/thread-subscription/'+this.threadID).then(response=>{
            this.subscribed = !this.subscribed
        })
    }
},
computed:{
    subscribeText(){
        if(this.subscribed){
            return "You have subscribed to this thread. Click to unsubscribe!"
        }
        else{
            return "Subscribe to this thread"
        }
    }
}

}
 
</script>