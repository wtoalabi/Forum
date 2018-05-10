<template>
<div class="">
    <div class="column">
        <div v-if="!clicked"><button @click="newThread" class="button is-primary new_thread_button">Create a New Thread...</button></div>
        <div v-else><button @click="closeThreadForm" class="button is-danger new_thread_button">Cancel New Thread..</button></div>
    </div>
</div>
</template>

<script>
export default {
  mounted() {},
  data() {
    return {
      clicked: false
    };
  },
  methods: {
    newThread() {
      this.$store.commit("loadNewThreadForm");
      this.clicked = true;
    },
    createNew() {
      this.showForm = "is-active";
    },
    closeThreadForm() {
      this.$store.commit("closeThreadForm");
      this.clicked = false;
    }
  },
  computed: {
    fullname() {
      return this.$store.getters.getLoggedInUserFullName;
    }
  }
};
</script>