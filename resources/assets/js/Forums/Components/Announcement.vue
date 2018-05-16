<template>
<div>
    <div v-if="announcement.message" class="">
        <article class="message is-warning">
            <div class="message-header">
                <p>{{message}}</p>
            </div>
        </article>
    </div>
</div>
</template>

<script>
 
export default {

mounted() {

},
methods:{
},
computed:{
   announcement(){
       return this.$store.state.announcement
    },
    message(){
        return this.$store.state.announcement.message
        }
    }
}
</script>