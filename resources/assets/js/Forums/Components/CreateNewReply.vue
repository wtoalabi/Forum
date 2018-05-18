<template>
    <div>
        <div id="replies">
            <replies></replies>
        </div>
        <h1>Create new reply....</h1>
        <textarea name="body" class="textarea" placeholder="Wanna add something?" v-model="form.body"></textarea>
        <button v-scroll-to="'#replies'" class="button is-info" @click="submitReply">Submit</button>
    </div>
</template>

<script>
    import Form from "../../Utilities/Form"
    export default {

        mounted() {
        },
        data() {
            return {
                form: new Form({
                    body: ""
                })
            }
        },
        methods: {
            submitReply() {
                const id = this.$store.getters.getSingleThread.id;
                return this.form.post("api/create-new-reply/"+id).then(response => {
                    if(response.status == 200){
                        this.$store.commit("commitReply", response.reply)
                        this.$store.state.announcement =   {color: 'is-success',message:"Reply Added!"}  
                    }
                    

                })
            }

        }

    }
</script>