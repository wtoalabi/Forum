<template>
<div class="columns is-gapless">
    <div class="column is-2 asideA"><sidebarA/></div>
    <div class="column"><breadcrumbs></breadcrumbs> <router-view></router-view></div>
    <div class="column is-2 asideB"><sidebarB /></div>
</div>

</template>
<script>
import SidebarA from './Menu/SidebarA'
import SidebarB from './Menu/SidebarB'
 
export default {
props:['loggedinuser'],
 components:{
     'sidebarA': SidebarA,
     'sidebarB': SidebarB,
 },
mounted() {    
    this.setState()
},
methods:{
    setState(){
        this.$store.dispatch('getUser', this.loggedinuser)
    }
}

}
 
</script>