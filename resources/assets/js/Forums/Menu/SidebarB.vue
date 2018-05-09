<template>
<div class="">
    <div class="column">
        <div class="columns is-centered">
        <div v-if="fullname" class="column is-offset-2">
            <p class="button">{{fullname}}</p>
        </div>
        <div v-else>Loading...</div>
        </div>
    </div>
</div>
</template>

<script>
 
export default {
 
mounted() {    
},
computed:{
    fullname(){
        return this.$store.getters.getLoggedInUserFullName
    }
}

}
 
</script>