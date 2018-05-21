<template>
<div>
    <h1>Notifications</h1>
    <div v-for="notification in notifications" :key="notification.id">
        <ul>
            <li @click="read(notification.id)">{{notification.data.message}}</li>
        </ul>
    </div>
</div>
</template>

<script>
import store from '../../Store/store'
export default {
    mounted() {},
    methods:{
      read(id){
          return axios.delete('api/notifications/'+id).then(
              this.$store.state.notifications.data.splice(id,1)
          )
        }
    },
  computed:{
      notifications(){
            return this.$store.state.notifications.data
      }
  }
  
};
</script>