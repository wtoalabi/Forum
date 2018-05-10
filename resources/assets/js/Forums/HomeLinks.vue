<template>
<div>
    <div></div>
<div class="columns is-gapless">
    
    
    <div class="column is-2 asideA"><sidebarA/></div>
    <div class="column"><mast /> <router-view></router-view></div>
    <div class="column is-2 asideB"><sidebarB /></div>
    
</div>
</div>
</template>
<script>
import SidebarA from "./Menu/SidebarA";
import SidebarB from "./Menu/SidebarB";

import { mapActions } from "vuex";
export default {
  props: ["loggedinuser"],
  components: {
    sidebarA: SidebarA,
    sidebarB: SidebarB
  },
  mounted() {
    this.setState();
  },
  methods: {
    ...mapActions(["storeUser", "storeAllThreads"]),
    setState() {
      this.storeUser(this.loggedinuser);
      this.storeAllThreads();
    }
  }
};
</script>