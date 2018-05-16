<template>
<div>
    <span v-scroll-to="'#top'" @click="deleteClicked" class="button is-primary mt--1">Delete</span>
</div>
</template>

<script>
 
export default {

props: ['url', 'mutator','name','redirectedPath'],

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
        return setTimeout(()=>{
            this.$store.state.announcement.message = ''
        }, 4000)
    },
    errorMessage(message){
        this.$store.state.announcement.message = message
        this.$router.push({'path': this.redirectedPath})
        return setTimeout(()=>{
            this.$store.state.announcement.message = ''
        }, 4000)
    }
},

}
 
</script>