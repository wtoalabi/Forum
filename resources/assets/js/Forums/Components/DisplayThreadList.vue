<template>
<div>
    <div class="column is-12" v-for="thread in threads" :key="thread.id">
        <div class="box content is-small">
            <h1 class=""><router-link :to="'/threads/' + thread.category.slug + '/' + thread.slug " exact><span>{{thread.title}}</span></router-link></h1>
            <small>Posted in  {{thread.category.name}} || {{thread.created_at}} ||Replies:{{thread.replies_count}} || <router-link :to="'/users/' + thread.user.username"><span>{{thread.user.name}}</span></router-link></small>
            <h2>{{thread.body | readMore}}</h2>
        </div>
    </div>
</div>
</template>

<script>
 
export default {
props:['threads'],
mounted() {

},
filters: {
    readMore(text) {
      return _.truncate(text, { length: 100 });
    }
  }

}
 
</script>