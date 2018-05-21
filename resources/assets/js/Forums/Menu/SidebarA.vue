<template>
    <div class="column is-offset-0">
        <aside class="menu">
            <p class="menu-label">
                General
            </p>
            <ul class="menu-list">

                <li>
                    <router-link to="/notifications">
                        <span>Notifications</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/">
                        <span>Forums List</span>
                    </router-link>
                </li>
                <li @click="clicked">
                    <router-link to="/threads" exact >
                        <span>Thread</span>
                    </router-link>
                </li>

            </ul>
            <ul class="menu-list">
                <li>
                    <a :class="{'is-active':selected}" @click="isSelected">Categories</a>
                </li>
                <li v-if="selected">
                    <ul>
                        <!-- <li v-for="category in categories" :key="category.id"><a :href="'#/' + category.slug">{{category.name}} ({{category.threads_count}})</a></li> -->
                        <li v-for="category in categories" :key="category.id">
                            <router-link :to="'/threads/query?filterCategory='+ category.slug">{{category.name}}</router-link>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="menu-list">
                <li>
                    <a class="is-active">Sort</a>
                </li>
                <li>
                    <ul>
                        <!-- <li v-for="category in categories" :key="category.id"><a :href="'#/' + category.slug">{{category.name}} ({{category.threads_count}})</a></li> -->
                        <li>
                            <router-link to="/threads/query?sortByPopular=1">Popular</router-link>
                        </li>
                    </ul>
                </li>
            </ul>
            <p class="menu-list">
                
                     <router-link class="" :to="'/threads/query?sortByUser=' + loggedInUser">My Threads</router-link>
            </p>
            <p class="menu-label">
                Tags
            </p>
        </aside>

    </div>
</template>

<script>
    export default {
        
        mounted(){
        },

        data() {
            return {
                selected: null,
               // count: this.$store.state.notifications.data.length
            }
        },
        methods: {
            isSelected() {
                this.selected ^= true
            },
            clicked(){
                if(_.isEmpty(this.$store.state.threads)){
                this.$store.state.pageIsLoading = true
                return axios.get('api/threads/').then(response => {
                this.$store.commit("commitThreads", response.data)
                this.$store.state.pageIsLoading = false
                })
                }
            },
        },
        computed: {
            
            categories() {
                return this.$store.getters.getCategories
            },
            loggedInUser(){
                return this.$store.state.loggedInUserID
            }
        }
    }
</script>