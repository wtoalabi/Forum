<template>
<div>
    <div v-if="isLoading">Loading....</div>
    <div v-else><threadslist :threads="threads.data"></threadslist></div>
    <pagination 
        url="api/all-threads" 
        mutator="commitThreads" 
        :meta="threads.meta" 
        :links="threads.links">
    </pagination>
</div>
</template>

<script>
export default {
  created() {      
  },

  methods: {},
  data() {
    return {
      isLoading: false,
    };
  },

  computed:{
      threads(){
          return this.$store.getters.getAllThreads;
      }
  }
  
};
</script>