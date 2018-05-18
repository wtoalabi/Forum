<template>
<div>
    <div class="column is-centered">
            <div class="box column is-12">
                    Name: <span class="title is-6">{{profile.name}}</span> |
                    Username: <span class="title is-6">{{profile.username}}</span> |
                    Email: <span class="title is-6">{{profile.email}}</span>
                </div>
            <div class="columns">
                <div class="column is-12">
                <activities :user="user"></activities>
                </div>
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