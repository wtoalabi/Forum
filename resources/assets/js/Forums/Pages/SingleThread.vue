<template>
<div>
    <div v-if="isLoading">
        <h1 class="is-2"> Loading...</h1>
    </div>

    <div v-if="error">
        {{error}}
    </div>
    
    <div v-if="thread">
        <div class="column is-10 is-offset-1">
            <div class="content is-large"><h1>{{thread.title}}</h1>
            <hr/>
            <div class="columns">
                <div class="column is-5">
                    <em> {{thread.owner.name}}</em>
                    <p><a :href="thread.category.slug"><small>{{thread.category.name}} <span class="is-rounded is-small tag is-primary">{{thread.category.threads_count}}</span></small></a></p>
                </div>
                <div class="column is-4 is-offset-3">
                    <em>{{thread.created_at}}</em>
                </div>
            </div>
            <hr/>
            <p>{{thread.body}}</p>
            </div>
        </div>
        <hr/>
        <replies></replies>
        <newreply></newreply>
    </div>
</div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      isLoading: false,
      thread: null,
      error: null
    };
  },
  created() {
    this.getSingleThread();
  },
  watch: {
    $route: "getSingleThread"
  },
  methods: {
    getSingleThread() {
      this.error = this.thread = null;
      this.isLoading = true;
      axios
        .get("api/single-thread/" + this.$route.params.slug)
        .then(response => {
          this.isLoading = false;
          this.$store.commit("commitSingleThread", response.data.data);
          this.thread = this.$store.getters.getSingleThread;
        })
        .catch(error => {
          this.isLoading = false;
          this.error = error.response.statusText;
        });
    }
  }
};
</script>