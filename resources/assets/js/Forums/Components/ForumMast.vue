<template>
<div>
    <div class="column bread">
    <div class="columns is-centered">
    <div class="column is-4">
   <!--  <nav class="breadcrumb has-arrow-separator" aria-label="breadcrumbs">
        <button class="button is-info">{{breadcrumb}}</button>
        <li><router-link to="/threads"><span>Thread</span></router-link></li>
</nav> -->
</div>
<div class="column is-8">
 <search/>

</div>

</div>
</div>
</div>
</template>

<script>
import Search from "../Components/Search";
export default {
  mounted() {},
  components:{
      Search
  },
  data() {
    return {
      route: "",
      breadrumb: this.$store.getters.currentBreadcrumb
    };
  }
};
</script>