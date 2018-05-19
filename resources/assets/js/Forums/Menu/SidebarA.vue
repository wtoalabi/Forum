<template>
    <div class="column is-offset-0">
        <aside class="menu">
            <p class="menu-label">
                General
            </p>
            <ul class="menu-list">

                <li>
                    <router-link to="/notifications">
                        <span class="tag is-danger is-rounded">{{notificationsCount}}</span>
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
                            <router-link to="/threads/sort?by=popular">Popular</router-link>
                        </li>
                    </ul>
                </li>
            </ul>
            <p class="menu-label">
                Tags
            </p>
        </aside>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                selected: null
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
            notificationsCount() {
                return this.$store.getters.getNotificationsCount
            },
            categories() {
                return this.$store.getters.getCategories
            }
        }
    }
</script>