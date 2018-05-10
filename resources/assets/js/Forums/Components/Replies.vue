<template>
<div>
    <div class="content">
            <div class="columns is-centered" v-for="reply in thread.replies" :key="reply.id">
                <div class="column is-9 mt-1"><blockquote class="message is-primary">{{reply.body}} <span class="title is-5">--{{reply.user}}</span>, <em class="em">{{reply.created_at}}</em></blockquote>    </div>

            </div>
            </div>
</div>
</template>

<script>
 
export default {
mounted() {

},
computed:{
    thread(){
        return this.$store.getters.getSingleThread
    }
}

}
 
</script>