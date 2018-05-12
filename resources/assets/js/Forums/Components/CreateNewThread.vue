<template>
    <div>
        <div class="columns is-centered">
            <div class="column is-10">
                <div v-if="form.title || form.body">
                    <h1>Preview...</h1>
                    <div>
                        Title:
                        <span class="title is-5">{{form.title}}</span>
                    </div>
                    <div>
                        <p> Body: ({{bodyCount}} characters out of 300)</p>
                        <strong>
                            <em>{{form.body}}</em>
                        </strong>
                    </div>
                    <hr />
                </div>
                <div @keydown="form.errors.clear($event.target.name)">
                    <div class="field">
                        <label class="label">Title of the Thread</label>
                        <div class="control">
                            <input class="input" :class="{'is-danger':form.errors.has('title')}" name="title" type="text" placeholder="Text input" v-model="form.title">
                            <div v-if="form.errors.has('title')">
                                <span class="help is-danger">{{form.errors.get('title')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Message</label>
                        <div class="control">
                            <textarea name="body" class="textarea" :class="{'is-danger': form.errors.has('body')}" placeholder="Textarea" v-model="form.body"></textarea>
                        </div>
                        <div v-if="form.errors.has('body')">
                            <span class="help is-danger">{{form.errors.get('body')}}</span>
                        </div>
                    </div>
                    <div class="select" @change="form.errors.clear($event.target.name)" :class="{'is-danger': form.errors.has('category_id')}">
                        <select v-model="form.category_id">
                            <option disabled selected hidden value="">Select Appropriate Category</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
                        </select>
                        <div v-if="form.errors.has('category_id')">
                            <p class="help is-danger">{{form.errors.get('category_id')}}</p>
                        </div>
                    </div>
                    <div class="field is-grouped mt-3">
                        <div class="control">
                            <button class="button is-link" :class="{'is-loading': form.sendingMessage}" :disabled="disableForm || form.errors.any()" @click="submit">Submit</button>
                        </div>
                        <div class="control">
                            <button class="button is-text" @click="cancelForm">Cancel</button>
                        </div>
                        <div v-if="form.messageSent">Posted!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Form from '../../Utilities/Form'
    export default {
        mounted() {},
        data() {
            return {
                showForm: false,
                form: new Form({
                    title: "",
                    body: "",
                    category_id:""
                }),
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
                return this.form.body.length
            },
            categories(){
                return this.$store.getters.getCategories
            },
        },
        methods: {
            createNew() {
                this.showForm = "is-active";
            },
            closeForm() {
                this.showForm = null;
            },
            submit() {
                return this.form.post('api/create-new-thread').then(response => {
                    this.processResponse(response)})
            },
            processResponse(response) {
               this.$store.commit("addASingleThread", response.data)
               
            },
            cancelForm(){
                this.form.reset()
            }
        }
    };
</script>