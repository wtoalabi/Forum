export default {
    computed:{
        authorized(){
            return this.$store.state.loggedInUserID == this.id
        }
    }
}