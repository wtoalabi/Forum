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
                <announcement></announcement>
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
        props: ["loggedinuser",'isadmin'],
        components: {
            sidebarA: SidebarA,
            sidebarB: SidebarB,
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
                this.storeLoggedInUser({id:this.loggedinuser,isAdmin:this.isadmin});
            }
        }
    };
</script>