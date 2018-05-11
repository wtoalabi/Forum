<template>
<div class="column is-offset-0">
<aside class="menu">
  <p class="menu-label">
    General
  </p>
  <ul class="menu-list">
      
        <li><router-link to="/notifications"><span class="tag is-danger is-rounded">{{notificationsCount}}</span> <span>Notifications</span></router-link></li>
        <li><router-link to="/"><span>Forums List</span></router-link></li>
        <li><router-link to="/threads"><span>Thread</span></router-link></li>
    
  </ul>
  <p class="menu-label">
    Categories
  </p>
  <p class="menu-label">
    Tags
  </p>
</aside>

</div>
</template>

<script>
export default {
    computed:{
        notificationsCount(){
            return this.$store.getters.getNotificationsCount
        }
    }
}
 
</script>