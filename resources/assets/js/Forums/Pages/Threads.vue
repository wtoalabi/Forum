<template>
<div>
    <div v-if="isLoading">Loading....</div>
    <div v-else id="threads"><threadslist :threads="threads.data"></threadslist></div>
    <pagination 
        v-scroll-to="'#threads'"
        url="api/all-threads" >
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

  computed:{
      threads(){
          return this.$store.state.threads;
      }
  }
  
};
</script>