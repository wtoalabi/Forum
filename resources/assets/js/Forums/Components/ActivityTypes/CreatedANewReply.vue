<template>
<div>
    <h6>{{getName(data.user)}} created a reply on <a v-if="!sameOwner(data.object.user, data.user)" :href="objectUserProfile(data.object.user)">
            {{getObjectOwner(data.object.user, data.user)}}</a>
        <span v-else>{{getObjectOwner(data.object.user, data.user)}}</span>
        <a v-if="data.object" :href="objectThreadUrl(data)">thread</a> around {{data.created_at}}</h6>
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