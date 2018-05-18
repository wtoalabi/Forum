<template>
<div>
    <div v-if="announcement.message" class="alert">
        <article class="message" :class="color">
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
        },
        color(){
        return this.$store.state.announcement.color

        }
    }
}
</script>