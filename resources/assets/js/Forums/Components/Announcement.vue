<template>
<div>
    <div v-if="announcement.message" class="alert">
        <article class="message" :class="color">
            <div class="message-header">
                <p>{{message()}}</p>
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
    message(){
        setTimeout(()=>{
            return this.$store.state.announcement.message=''
            },3000)
        return this.$store.state.announcement.message
        },
},
computed:{
    color(){
        return this.$store.state.announcement.color
        },
    announcement(){
       return this.$store.state.announcement
    }
}
}
/* this.$nextTick().then(
            setTimeout(()=>{
                
                this.$store.state.announcement = ''
                console.log("mounted annoucement")
            }, 2000)
       ) */
</script>
