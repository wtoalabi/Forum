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
    console.log("threads");
    //console.log(this.$store.getters.getAllThreads);

    this.isLoading = true;
    if (_.isEmpty(this.threads)) {
      this.getThreads();
    }
    this.isLoading = false;
  },

  methods: {
    getThreads() {
      axios.get("api/all-threads").then(response => {
        this.$store.commit("commitThreads", response.data.data);
        this.threads = this.$store.getters.getAllThreads;
        //this.threads = response.data.data;
        this.isLoading = false;
      });
    }
  },
  data() {
    return {
      isLoading: false,
      threads: this.$store.getters.getAllThreads
    };
  },
  filters: {
    readMore(text) {
      return _.truncate(text, { length: 100 });
    }
  }
};
</script>