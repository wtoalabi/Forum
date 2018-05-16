<template>
    <div>
         
        <div class="columns is-gapless">
            <div class="column is-2 asideA">
                <sidebarA/>
            </div>
            <div v-if="loadNewThreadForm" class="column">
                <mast />
                <newthread></newthread>
            </div>
            <div v-else class="column">                    
                    <mast />
                    <div class="columns is-centered">
                        <div id="top" class="column is-11">
                            <announcement></announcement>
                        </div>
                    </div>
                <spinner v-if="pageIsLoading" size="massive" message="Loading..."></spinner>
                <div v-else>
                <transition><router-view></router-view></transition>
            </div>
            </div>
            <div class="column is-2 asideB">
                <sidebarB />
            </div>
        </div>
    </div>
</template>
<script>
    import SidebarA from "./Menu/SidebarA";
    import SidebarB from "./Menu/SidebarB";

    import {
        mapActions
    } from "vuex";
    export default {
        props: ["loggedinuser"],
        components: {
            sidebarA: SidebarA,
            sidebarB: SidebarB,
        },
        mounted() {
            
        },
        created() {
            this.setState();
        },
        data() {
            return {};
        },
        computed: {
            loadNewThreadForm() {
                return this.$store.getters.getNewThreadForm;
            },
            pageIsLoading(){
                return this.$store.state.pageIsLoading
            },
            
        },
        methods: {
            ...mapActions(["storeLoggedInUser", "storeAllThreads"]),
            setState() {
                this.storeLoggedInUser(this.loggedinuser);
                this.storeAllThreads();
            }
        }
    };
</script>