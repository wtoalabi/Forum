<template>
<div>
    <div class="columns is-centered">
        <div class="column is-5">
            <div class="box">
                <h1 class="title is-4"> User Details</h1>
                    <p>Name: <span class="title is-6">{{user.name}}</span></p>
                    <p>Username: <span class="title is-6">{{user.username}}</span></p>
                    <p>Email: <span class="title is-6">{{user.email}}</span></p>
            </div>
        </div>
        <div class="column is-5">
            <div class="box">User Forum Activities</div>
        </div>
    </div>
</div>
</template>

<script>
 
import store from '../../Store/store'
export default {
async beforeRouteEnter(to, from , next){
    store.state.pageIsLoading = true
    await store.dispatch("getUserProfile", to.params.username)
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
    user(){
        return this.$store.state.userProfile
    }
}

}
 
</script>