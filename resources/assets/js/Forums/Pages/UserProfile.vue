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
 
export default {
 
async mounted() {
    await axios.get('api/profile/' + this.$route.params.username).then(user=>{
        this.user = user.data.data
    })
},
data(){
    return{
        user: ''
    }
}


}
 
</script>