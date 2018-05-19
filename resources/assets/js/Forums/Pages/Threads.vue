<template>
<div>
    <div v-if="isLoading">Loading....</div>
    <div v-else id="threads"><threadslist :threads="threads.data"></threadslist></div>
    <pagination 
        v-scroll-to="'#threads'"
        :mainData="threads"
        nextPageCommitMessage="loadNextThreadsFromPagination"
        previousPageCommitMessage="loadPreviousThreadsFromPagination"
        paginationText="Threads">
    </pagination>

</div>
</template>

<script>
export default {
     mounted(){
         
     },
  methods: {},
  data() {
    return {
      isLoading: false,
    };
  },
  watch:{
      async '$route'(to, from){
          this.$store.state.pageIsLoading = true
          await this.$store.dispatch("getThreads", to.fullPath)
          this.$store.state.pageIsLoading = false
          
      }
  },

  computed:{
      threads(){
          return this.$store.state.threads;
      }
  }
  
};
</script>