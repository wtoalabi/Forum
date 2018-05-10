<template>
    <div>
        <div class="columns is-centered">
            <div class="column is-10">
                <div v-if="title || body">
                    <h1>Preview...</h1>
                    <div>
                        Title:
                        <span class="title is-5">{{title}}</span>
                    </div>
                    <div>
                        <p> Body: ({{bodyCount}} characters out of 300)</p>
                        <strong>
                            <em>{{body}}</em>
                        </strong>
                    </div>
                    <hr />
                </div>
                <div>
                    <div class="field">
                        <label class="label">Name of the Thread</label>
                        <div class="control">
                            <input class="input" type="text" placeholder="Text input" v-model="title">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Message</label>
                        <div class="control">
                            <textarea class="textarea" placeholder="Textarea" v-model="body"></textarea>
                        </div>
                    </div>
                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-link" :disabled="disableForm">Submit</button>
                        </div>
                        <div class="control">
                            <button class="button is-text">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {},
        data() {
            return {
                showForm: false,
                title: "",
                body: "",
            };
        },
        computed: {
            disableForm() {
                if (this.bodyCount > 300) {
                    return true
                } else {
                    return false
                }
            },
            bodyCount() {
                return this.body.length
            }
        },
        methods: {
            createNew() {
                this.showForm = "is-active";
            },
            closeForm() {
                this.showForm = null;
            }
        }
    };
</script>