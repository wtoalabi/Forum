<template>
<div>
    <div v-if="isLoading">Loading....</div>
    <div v-else class="column is-12" v-for="thread in threads" :key="thread.id">
        <div class="box content is-small">
            <h1 class=""><router-link :to="'threads/' + thread.slug "><span>{{thread.title}}</span></router-link></h1>
            <h2>{{thread.body | readMore}}</h2>
        </div>
    </div>
</div>
</template>

<script>
export default {
  created() {
    this.isLoading = true;
     if (_.isEmpty(this.threads)) {
      this.getThreads()
    } 
  },

  methods: {
    getThreads() {
        console.log("getting...");
        this.threads = this.$store.getters.getAllThreads;
        this.isLoading = false;
    }
  },
  data() {
    return {
      isLoading: false,
      threads: ''
    };
  },
  filters: {
    readMore(text) {
      return _.truncate(text, { length: 100 });
    }
  }
};
</script>