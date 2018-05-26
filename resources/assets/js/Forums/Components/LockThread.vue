<template>
<div>
    <span class="button" :class="buttonColor" @click="lock">
        <i class="fa mr-1" :class="padlock"></i> {{message}}</span>
</div>
</template>

<script>
 
export default {
mounted() {

},
data(){
    return {}
},
methods:{
    lock(){
        
        return axios.post('api/admin/lock/'+this.thread.id).then((response)=>{
            this.$store.state.announcement = {message:response.data.message,color:'is-primary'}
            if(response.data.status == "Locked"){
                return this.$store.state.singleThread.isLocked = true
            }
            else{
                return this.$store.state.singleThread.isLocked = false

            }
        })
    },
},
    computed:{
        message(){
            return this.isLocked ? 'Unlock Thread!' : 'Lock Thread!';
        },
        buttonColor(){
            return this.isLocked ? 'is-warning' : 'is-danger';
        },
        padlock(){
            return this.isLocked ? 'fa-unlock' : 'fa-lock'
        },
        thread(){
            return this.$store.state.singleThread
        },
        isLocked(){
            return this.thread.isLocked
        }
    }

}
 
</script>