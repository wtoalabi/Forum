<template>
<div >
    <div v-if="authorized" @click="loadEditComponent">
        <button class="button is-warning">Edit</button>
    </div>
    <component :is="editComponent" v-if="open" :content="content" :open="open" @close="close"></component>
</div>
</template>

<script>
 
import authorization from '../../Mixins/Authorization'
export default {
mixins:[authorization],
props:['id', 'editComponent','content'],
mounted() {

},
data(){
    return{
        open: false,
    }
},
methods:{
    loadEditComponent(){
        this.open = true
    },
    close(){
        this.open = false
    }
},
computed:{
}
}
 
</script>