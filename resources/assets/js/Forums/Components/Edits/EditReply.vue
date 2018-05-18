 <template>
<div>
    <div class="modal" :class="{'is-active':show}">
        <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Edit Your Reply...</p>
                    <button class="delete" aria-label="close" @click="close"></button>
                </header>
                <section class="modal-card-body">
                    <textarea class="textarea" name="body" v-model="body"></textarea>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-success" @click="saveReply">Save Changes!</button>
                    <button class="button" @click="close">Cancel</button>
                </footer>
            </div>
        </div>    
</div>
</template>

<script>
 
export default {
props:['content','open'],
mounted() {
    console.log(this.content.body);
    
},
data(){
    return{
        show: this.open,
        body: this.content.body
        
    }
},
methods:{
    saveReply(){
        return axios.patch('api/edit-reply/'+this.content.id, {'body': this.body}).then(changes=>{
            if(changes.data.status == 200){
                this.$store.commit("editedReply", changes.data.reply)
                this.$store.state.announcement = {color: 'is-success', message: 'Reply Edited!'}
                return this.close()
            }
            
            //this.close()
        })
    },
    close(){
       this.$emit('close')
    }
}

}
 
</script>