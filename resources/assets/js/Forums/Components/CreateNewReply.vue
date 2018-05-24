<template>
    <div>
        <div id="replies">
            <replies></replies>
        </div>
    
        <h1>Create new reply....</h1>
        <at-ta :members="members">
            <textarea name="body" :class="{'is-danger': error}" class="textarea" 
                placeholder="Wanna add something?" v-model="form.body"></textarea>
        </at-ta>
    
        <div v-if="error"><span class="has-text help is-danger">{{error}}</span></div>
            <button class="button is-info" @click="submitReply">Submit</button>
    </div>
</template>

<script>
var VueScrollTo = require('vue-scrollto')
import AtTa from 'vue-at/dist/vue-at-textarea'
    import Form from "../../Utilities/Form"
    export default {
        components:{ AtTa},
        mounted() {
            
        },
        data() {
            return {
                form: new Form({
                    body: ""
                }),
                error: '',
                members: [],
            }
        },
        watch:{
            /* This watcher watches the value of the body for changes. Extracts the changed 
            values to check if they include the @symbol. If they do, the texts are then returned 
            and compared to each other to prevent incessant call to the api after each keystroke.
            */
            "form.body": function(oldValue, newValue){
                let oldvalue = this.extractUsername(oldValue)
                let newvalue = this.extractUsername(newValue)

                if(newvalue != oldvalue){
                    let usernames = JSON.parse(oldvalue)
                    if(_.last(usernames)){
                        return  axios.post('api/get-mentioned-user',{'name': _.last(usernames)})
                            .then(response=>{
                            this.members= response.data      
                        })
                    }
                } 
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
                
            },
            /* The given text is first split into an array of texts, those that do not 
                contain the @ symbol are then filtered out. Next, each @text is returned 
                without the @symbol and then that value is JSON.Stringfied to make it easy 
                for comparison when the caller of the function needs to do so.
            */
            extractUsername(text){
                text = text.split(" ").filter((each)=>{
                    return each.match('@')
                }).map((each)=>{
                    each = each.substring(1)
                    return each
                }) 
                return JSON.stringify(text)
            },

        }

    }
</script>