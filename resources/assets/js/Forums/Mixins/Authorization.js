export default {
    computed:{
        authorized(){
            return this.$store.state.loggedInUser.id == this.id
        }
    }
}