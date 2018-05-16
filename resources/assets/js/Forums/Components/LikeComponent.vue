<template>
<div>
    <div class="field is-grouped is-grouped-multiline">
        <div class="control">
            <div class="tags has-addons">
                <a @click="likeButtonClicked" class="icon has-text-black" :title="likedText">
                    <span class="tag is-light">{{count}}</span>
                    <span class="tag has-text-white " :class="likedColour" ><i class="fa fa-heart"></i></span>
                </a>
            </div>
        </div>
    </div>
</div>
</template>

<script>
 
export default {
props:['count', 'ID','liked', 'url','addCountMutator', 'removeCountMutator'],
mounted() {

},
data(){
    return {
    }
},
methods:{
    likeButtonClicked(){
        axios.post(this.url+this.ID).then(response=>{
            if(response.data === 1){
                this.$store.commit(this.addCountMutator, this.ID)
            }
            else if(response.data === 0){
                this.$store.commit(this.removeCountMutator, this.ID)
            }
            
        })
    }
},
computed:{
      likedText(){
          if(this.liked === true){
              return "Click to Unlike!"
          }
          else{
              return "Click to Like!"
          }
      },
      likedColour(){
          if(this.liked){
              return "is-danger"
          }
          else{
              return "is-info"
          }
      }
}

}
 
</script>