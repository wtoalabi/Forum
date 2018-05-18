<template>
<div>
    <div class="box content">User Forum Activities
        <div class="content" v-for="activity in activities" :key="activity.id">
            <ul>
                <li>
                    <component :is="activity.type" :data="activity"></component>
                </li>
            </ul>
        </div>
    </div>
</div>
</template>

<script>
import created_thread from './ActivityTypes/CreatedNewThread'
import deleted_thread from './ActivityTypes/DeletedAThread'
import created_reply from './ActivityTypes/CreatedANewReply'
import deleted_reply from './ActivityTypes/DeletedAReply'

export default {
components:{
    'created_thread':created_thread,
    'deleted_thread':deleted_thread,
    'created_reply': created_reply,
    'deleted_reply': deleted_reply
},
props:['user'],
mounted() {

},
methods:{},
computed:{
    activities(){
        return this.$store.state.userActivities.data
        
    }
},
}
 
</script>