<template>
<div>
    <div class="box">User Forum Activities
            <div v-for="activity in activities" :key="activity.id">
                <ul>
                    <li>
                        {{user}} {{activity.activity_type | event}} 
                        <a v-if="activity.activity_subject_title && activity.activity_subject" :href="checkSlug(activity)"> {{activity.activity_subject_title}}</a> 
                        <span v-if="activity.activity_subject_title && activity.activity_subject == null">({{activity.activity_subject_title}})</span>
                        about {{activity.activity_created_at}}
                    </li>
                </ul>
            </div>
    </div>
</div>
</template>

<script>
 
export default {
props:['user'],
mounted() {

},
methods:{
    title(title){
        return title
    },
    checkSlug(activity){
        console.log(activity);
        
        switch(activity.activity_type){
            case "created_thread": 
            return "forums#/threads/" + activity.activity_subject.category.slug + "/"+ activity.activity_subject.slug
        }
        
    }
},
computed:{
    activities(){
        return this.$store.state.userActivities.data
    }
},
filters:{
    event(activity){
        switch(activity){
            case 'deleted_thread':
                return "deleted thread"
            case 'created_thread':
                return "created a thread"
            case 'created_reply':
                return "created a reply"
            case 'deleted_reply':
                return "deleted a reply"
            default:
                return ''
        }
        
    },
}

}
 
</script>