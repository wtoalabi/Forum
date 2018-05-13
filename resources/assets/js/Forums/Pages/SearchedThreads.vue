<template>
<div>
    <div v-if="loading">Loading...</div>
    <div v-else>
    <h1>Searched Terms:</h1>
        <threadslist :threads="threads"></threadslist>
    </div>
</div>
</template>

<script>
 
export default {
 
 watch: {
    '$route' (to, from) {
    this.loading = true
    return axios.get('api/searched-threads/' + to.params.username).then(response =>{
         this.$store.commit("commitSearchedThreads", response.data.data)
        this.loading = false
        })      
    }
  },
mounted() {
if(_.isEmpty(this.$store.state.searchedThreads)){
    this.loading = true
}
    
},
data(){
return{
    loading : false,
}
},
methods:{    
},
computed:{
    threads(){
        return this.$store.state.searchedThreads
    },
}

}
 
</script>