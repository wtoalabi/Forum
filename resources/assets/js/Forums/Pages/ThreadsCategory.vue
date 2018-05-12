<template>
<div>
    <div v-if="loading">Loading...</div>
    <div v-else>
    <h1>{{threadCategory}}</h1>
        <threadslist :threads="threads"></threadslist>
    </div>
</div>
</template>

<script>
 
export default {
 
 watch: {
    '$route' (to, from) {
    this.loading = true
     return axios.get('api/category-threads/' + to.params.category_slug).then(response =>{
         this.$store.commit("commitSingleCategoryThreads", response.data.data)
        this.loading = false
        })       
    }
  },
mounted() {
if(_.isEmpty(this.$store.state.singleCategoryThreads)){
    this.loading = true
}
    
},
data(){
return{
    loading : false,
    category_name: ''
}
},
methods:{    
},
computed:{
    threads(){
        return this.$store.state.singleCategoryThreads
    },
    threadCategory(){
        return _.head(this.$store.state.singleCategoryThreads).category.name
    }
}

}
 
</script>