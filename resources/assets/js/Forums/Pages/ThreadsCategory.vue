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
 
 watch: {
    '$route' (to, from) {
    this.$store.state.pageIsLoading = true
     return axios.get('api/category-threads/' + to.params.category_slug).then(response =>{
         this.$store.commit("commitSingleCategoryThreads", response.data.data)
        this.$store.state.pageIsLoading = false
        })       
    }
  },
mounted() {
if(_.isEmpty(this.$store.state.singleCategoryThreads.data)){
}
    
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
        return this.$store.state.singleCategoryThreads.data
    },
    threadCategory(){
        return _.head(this.$store.state.singleCategoryThreads.data).category.name
    }
}

}
 
</script>