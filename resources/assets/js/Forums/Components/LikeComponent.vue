<template>
<div>
    <div class="field is-grouped is-grouped-multiline">
        <div class="control">
            <div class="tags has-addons">
                <a @click="likeButtonClicked" class="icon has-text-black" :title="likedText">
                    <span class="tag is-light">{{count}}</span>
                    <span class="tag is-info has-text-white" :class="{'has-text-warning': liked }" ><i class="fa fa-heart"></i></span>
                </a>
            </div>
        </div>
    </div>
    <!-- <a @click="likeButtonClicked" class="icon has-text-black" :title="likedText" :class="{'has-text-danger': liked }">{{count}} <i class="fa fa-heart"></i></a> -->
</div>
</template>

<script>
 
export default {
props:['count', 'threadID'],
mounted() {

},
data(){
    return {
        liked: false
    }
},
methods:{
    likeButtonClicked(){
        axios.post('api/like-thread/'+this.threadID).then(response=>{
            if(response.data === 1){
                this.$store.commit("commitLikeCountOfAThread", this.threadID)
            }
            else if(response.data === 0){
                this.$store.commit("removeLikeCountOfAThread", this.threadID)
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
      }
}

}
 
</script>