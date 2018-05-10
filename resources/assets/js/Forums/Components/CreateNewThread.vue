<template>
<div>
    <div class>
        <button @click="createNew" class="button new_thread_button">Create a New Thread...</button>
        </div>
        <div>
            <div class="modal" :class="showForm">
                <div class="modal-background" @click="closeForm"></div>
                    <div class="modal-card">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Modal title</p>
                                <button class="delete" aria-label="close" @click="closeForm"></button>
                        </header>
                        <section class="modal-card-body">
                        <!-- Content ... -->
                        </section>
                        <footer class="modal-card-foot">
                            <button class="button is-success">Save changes</button>
                            <button class="button" @click="closeForm">Cancel</button>
                        </footer>
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
      showForm: false
    };
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

