<template>
<div>
    <h6>{{getName(data.user)}} created a new<a :href="subjectThreadUrl(data)">
        thread 
        </a>
        
        <!-- <a v-if="data.object" :href="objectUrl(data)">thread</a> around {{data.created_at}} -->
        </h6>
</div>
</template>

<script>
 
import activitiesMixins from '../../Mixins/ActivitiesMixin'
export default {
props:['data'],
mixins: [activitiesMixins],
mounted() {},
methods:{

},
computed:{
   
},
filters:{}

}
 
</script>