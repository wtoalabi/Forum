<template>
<div class="">
    <div class="column">
        <newthread></newthread>
    </div>
</div>
</template>

<script>
export default {
  mounted() {},
  computed: {
    fullname() {
      return this.$store.getters.getLoggedInUserFullName;
    }
  }
};
</script>