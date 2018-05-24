<template>
<div class="">
    <div class="column">
        <div v-if="!clicked" dusk="createNew"><button @click="newThread" class="button is-primary new_thread_button">Create a New Thread...</button></div>
        <div v-else><button @click="closeThreadForm" class="button is-danger new_thread_button">Cancel New Thread..</button></div>
        <div v-if="trending">
            <h1>Trending Threads</h1>
            <div v-for="trend in trending" :key="trend.slug">
                <a :href="'forums#/threads/'+trend.slug">{{trend.title}}</a>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
  mounted() {
      this.$store.commit('loadTrendingThreads')
  },
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
    },
    trending(){
        if(!_.isEmpty(this.$store.state.trending)){
            return this.$store.state.trending
        }
    }
  }
};
</script>