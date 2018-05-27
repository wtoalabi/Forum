<template>
    <div>
        <div class="field has-addons">
            <div class="control is-expanded">
                <input class="input" type="text" 
                        placeholder="Search Forums..." v-model="searchText">
            </div>
        <div class="control">
            <a class="button is-info">
                Search
            </a>
        </div>
        </div>
        <div class="notification" v-if="searchText">
            <p class="title is-6">Results:</p>
            <div v-for="result in searchResults" :key="result.id" class="message" @click="clear">
                <router-link :to="'/threads/' + result.path">{{result.title}}...</router-link>
            </div>
        </div>
    </div>
</template>

<script>
 
export default {
 
mounted() {

},

data(){
    return{
        searchText: '',
        searchResults: ''
    }
},
watch:{
    searchText(){
        if(this.searchText.length >1){
            return axios.get('api/search/query?search='+this.searchText).then((response)=>{
                console.log(response.data.data);            
                this.searchResults = response.data.data
            })
        }
    }
        
},
methods:{
    clear(){
        return  this.searchText = ''
    }
        
},
filters:{
    limit(text){
        return _.truncate(text, { length: 20 });
    }
}
}
 
</script>