<template>
<div v-if="unReadCount != undefined">
    <div class="dropdown is-hoverable is-right" >
  <div class="dropdown-trigger">
      <span class="is-rounded is-small tag" :class="{'is-danger': unReadCount>0}">
            <h1 class="has-text"><i class="fa fa-bell"></i> {{unReadCount}}</h1>
        </span>
  </div>
  <div class="dropdown-menu" id="dropdown-menu3" role="menu">
    <div class="dropdown-content">
      <div class="dropdown-item">
        <div v-for="notification in notifications" :key="notification.id">
            <a class="" :class="{'unRead': notification.read_at == null}" 
                :href="'/forums#/threads/'+notification.data.link" @click="read(notification.id)">
                <div class="columns">
                    <div class="column is-2">
                        <img class="is-circle" :src="notification.userImage" alt="">
                    </div>
                <div class="column">
                    <span>{{notification.data.message | reduce}}</span> 
                    <p>{{notification.created_at}}</p>
                </div>
                </div>
                <hr class="dropdown-divider">
            </a>
        </div>
      </div>
    </div>
  </div>
</div>
    
     <!-- <router-link to="/notifications">
        <span class="is-rounded is-small tag" :class="{'is-primary': count>0}">
            <h1 class="has-text"> <i class="fa fa-bell"></i> {{count}}</h1>
        </span>
    </router-link> -->
    </div>
</template>

<script>
 
export default {
props:['propscount'],
 
mounted() {
    this.$store.commit("getNotifications")
},
methods:{
    read(id){
        this.$store.dispatch("readNotification", id)
    }
},
computed:{
    unReadCount(){
        if(this.$store.state.notifications.data == null){
            return undefined
        }
        else{
            return this.$store.state.notifications.count.unRead
        }
    },
    notifications(){
        return _.take(this.$store.state.notifications.data, 7)
    }
},
filters: {
    reduce(text) {
      return _.truncate(text, { length: 45 });
    }
  },
}
 
</script>
<style>
[v-cloak] {
  display: none;
}
</style>
