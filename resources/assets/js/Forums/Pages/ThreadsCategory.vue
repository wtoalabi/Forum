<template>
<div>
    <div>
    <h1>{{threadCategory}}</h1>
        <threadslist :threads="threads"></threadslist>
    </div>
</div>
</template>

<script>
 
export default {
   beforeRouteUpdate(to, from, next){    
    this.$store.state.pageIsLoading = true
    return axios.get('api/category-threads/' + to.params.category_slug).then(response =>{
    this.$store.commit("commitThreads", response.data)
    this.$store.state.pageIsLoading = false
    next()
}) 
      
  },
mounted() {

    
},
data(){
return{
    category_name: ''
}
},
methods:{    
},
computed:{
    threads(){
        return this.$store.state.threads.data
    },
    threadCategory(){
        return _.head(this.$store.state.threads.data).category.name
    }
}

}
 
</script>