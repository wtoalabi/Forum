<template>
<div>
    <div class="column bread">
    <div class="columns is-centered">
    <div class="column is-7">
    <nav class="breadcrumb has-arrow-separator is-medium" aria-label="breadcrumbs">
        <ul>
            <li v-for="menu in breadcrumbs" :key="menu">
                <a href="#">{{menu}}</a>
            </li>        
        </ul>
    </nav>
</div>
<div class="column is-5">
    <div class="columns is-gapless">
        <div class="column is-3"></div>
        <div class="column is-10">
            <div class="field has-addons">
  <div class="control">
  </div>
    <input class="input" type="text" placeholder="Search forums...">
  <div class="control">
    <a class="button is-info">
      Search
    </a>
  </div>
</div>
        </div>
    </div>
</div>

</div>
</div>
</div>
</template>

<script>
 
export default {
 
mounted() {

},
data(){
    return{
        breadcrumbs: []
    }
}

}
 
</script>