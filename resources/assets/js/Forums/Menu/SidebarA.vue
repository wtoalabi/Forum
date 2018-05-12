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
   <ul class="menu-list">
    <li><a :class="{'is-active':selected}" @click="isSelected">Categories</a></li>
    <li v-if="selected">
      <ul>
        <li v-for="category in categories" :key="category.id"><a :href="category.slug">{{category.name}} ({{category.threads_count}})</a></li>
      </ul>
    </li>
  </ul>
  <p class="menu-label">
    Tags
  </p>
</aside>

</div>
</template>

<script>
export default {
    data(){
        return{
            selected: null
        }
    },
    methods:{
        isSelected(){
            this.selected ^= true
        }
    },
    computed:{
        notificationsCount(){
            return this.$store.getters.getNotificationsCount
        },
        categories(){
            return this.$store.getters.getCategories
        }
    }
}
 
</script>