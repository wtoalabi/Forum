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
                    this.$store.commit("commitReply", response.data)
                })
            }

        }

    }
</script>