<template>
<div v-if="authorized">
    <span v-scroll-to="'#top'" @click="deleteClicked" class="button is-danger mt--1">Delete</span>
</div>
</template>

<script>
import authorization from '../Mixins/Authorization' 
export default {

props: ['id','url', 'mutator','name','redirectedPath'],
mixins:[authorization],
mounted() {    

},

methods:{
    deleteClicked(){
        if(confirm("You want to delete this " + this.name + ' ?')){
            axios.delete(this.url).then(response=>{
                this.$store.commit(this.mutator, response.data)
                if(response.data.message == "Done" ){
                    return this.deletedMessage()
                }
                else{
                    return this.errorMessage(response.data.message)
                }
            })
        }
            
    },
    deletedMessage(){
        this.$store.state.announcement.message = "This " + this.name + " has been deleted!"
        this.$router.push({'path': this.redirectedPath})
    },
    errorMessage(message){
        this.$store.state.announcement.message = message
        this.$router.push({'path': this.redirectedPath})
    }
},
computed:{
    /* authorized(){
        return this.id == this.$store.state.loggedInUserID
    } */
}

}
 
</script>