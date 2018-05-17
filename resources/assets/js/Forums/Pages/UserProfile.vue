<template>
<div>
    <div class="columns is-centered">
        <div class="column is-4">
            <div class="box">
                <h1 class="title is-4"> User Details</h1>
                    <p>Name: <span class="title is-6">{{profile.name}}</span></p>
                    <p>Username: <span class="title is-6">{{profile.username}}</span></p>
                    <p>Email: <span class="title is-6">{{profile.email}}</span></p>
                </div>
            </div>
            <div class="column is-7">
                <activities :user="user"></activities>
            </div>
    </div>
</div>
</template>

<script>
 
import store from '../../Store/store'
export default {
async beforeRouteEnter(to, from , next){
    store.state.pageIsLoading = true
    await store.dispatch("getUserDetails", to.params.username)
    store.state.pageIsLoading = false
    next()

},
mounted() {
},
data(){
    return{
    }
},
computed:{
    profile(){
        return this.$store.state.userProfile
    },
    user(){
        if(this.$store.state.loggedInUserID == this.$store.state.userProfile.user_id){
            return "You"
        }
        else{
            return this.$store.state.userProfile.name
        }
    }
    
}

}
 
</script>