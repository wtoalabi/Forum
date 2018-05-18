<template>
<div>
    <h6>{{getName(data.user)}} deleted a reply on <a v-if="!sameOwner(data.object.user, data.user)" :href="objectUserProfile(data.object.user)">
            {{getObjectOwner(data.object.user, data.user)}}</a>
        <span v-else>{{getObjectOwner(data.object.user, data.user)}}</span> <a :href=" 'forums#/threads/'+data.object.category.slug + '/' + data.object.slug">thread</a> around {{data.created_at}}</h6>
</div>
</template>

<script>
 
import activitiesMixins from '../../Mixins/ActivitiesMixin'
//activitiesMixins = require('../../Mixins/ActivitiesMixin')
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