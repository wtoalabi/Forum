<template>
<div>
    <div v-if="loading">Loading...</div>
    <div v-else>
    <h1>{{user}}</h1>
        <threadslist :threads="threads"></threadslist>
    </div>
</div>
</template>

<script>
 
export default {
 
 watch: {
    '$route' (to, from) {
    this.loading = true
    console.log(to);
    
     return axios.get('api/user-threads/' + to.params.username).then(response =>{
         this.$store.commit("commitUserThreads", response.data.data)
        this.loading = false
        })      
    }
  },
mounted() {
if(_.isEmpty(this.$store.state.userThreads.data)){
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
        return this.$store.state.userThreads.data
    },
    user(){
        return _.head(this.$store.state.userThreads.data).user.name
    }
}

}
 
</script>