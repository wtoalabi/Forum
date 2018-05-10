<template>
<div>
    <div class="column bread">
    <div class="columns is-centered">
    <div class="column is-6">
    <nav class="breadcrumb has-arrow-separator" aria-label="breadcrumbs">
        <button class="button is-info">{{breadcrumb}}</button>
        <li><router-link to="/threads"><span>Thread</span></router-link></li>
</nav>
</div>
<div class="column is-6">
    <div class="field has-addons">
  <div class="control is-expanded">
    <input class="input" type="text" placeholder="Search Forums...">
  </div>
  <div class="control">
    <a class="button is-info">
      Search
    </a>
  </div>
</div>

</div>

</div>
</div>
</div>
</template>

<script>
export default {
  mounted() {
    console.log(this.$store.getters.currentBreadcrumb);
  },
  data() {
    return {
      route: "",
      breadrumb: this.$store.getters.currentBreadcrumb
    };
  }
};
</script>