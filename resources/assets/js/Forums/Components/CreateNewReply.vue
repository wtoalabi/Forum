<template>
    <div>
        <div id="replies">
            <replies></replies>
        </div>
        <h1>Create new reply....</h1>
        <textarea name="body" :class="{'is-danger': error}" class="textarea" placeholder="Wanna add something?" v-model="form.body"></textarea>
        <div v-if="error"><span class="has-text help is-danger">{{error}}</span></div>
        <button class="button is-info" @click="submitReply">Submit</button>
        <!-- <span v-scroll-to="'#replies'" v-if="!error"></span> -->
    </div>
</template>

<script>
var VueScrollTo = require('vue-scrollto')
    import Form from "../../Utilities/Form"
    export default {

        mounted() {
            
        },
        data() {
            return {
                form: new Form({
                    body: ""
                }),
                error: ''
            }
        },
        methods: {
            submitReply() {
                const id = this.$store.getters.getSingleThread.id;
                return this.form.post("api/create-new-reply/"+id).then(response => {
                    if(response.status == 200){
                        this.$store.dispatch("submitReply", response.reply)
                        this.$store.state.announcement =   {color: 'is-success',message:"Reply Added!"}  
                        this.error = ''
                        VueScrollTo.scrollTo('#replies', 500)
                    }
                    

                }).catch(error=>{
                    if(error.errors){
                        this.error = error.errors.body[0]
                    }
                    else{
                        this.error = error
                    }
                })
                
            }

        }

    }
</script>