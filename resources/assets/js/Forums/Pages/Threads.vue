<template>
<div>
    <div v-if="isLoading">Loading....</div>
    <div v-else><threadslist :threads="threads"></threadslist></div>
</div>
</template>

<script>
export default {
  created() {
    this.isLoading = true;
     if (_.isEmpty(this.threads)) {
      this.getThreads()
    } 
  },

  methods: {
    getThreads() {
        this.threads = this.$store.getters.getAllThreads;
        this.isLoading = false;
    }
  },
  data() {
    return {
      isLoading: false,
      threads: ''
    };
  },
  
};
</script>