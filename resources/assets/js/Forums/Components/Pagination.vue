<template>
    <div class="">
        <nav v-show="paginate" class="pagination is-rounded" role="navigation" aria-label="pagination">
            <a class="pagination-previous" :disabled="onFirstPage" @click="loadPreviousPage">Previous Set of Threads</a>
            <a class="pagination-next" :disabled="onLastPage" @click.prevent="loadNextPage">Next Set of Threads</a>
        </nav>
    </div>
</template>

<script>
    export default {
        props: ['meta', 'url', 'mutator', 'links'],
        mounted() {
            console.log("meya", this.meta);
            this.setButtons(this.meta)
            this.setPagination(this.links)
        },
        data() {
            return {
                paginate: true,
                onFirstPage: false,
                onLastPage: false,
                pageUrl: '',
                nextPage: '',
                prevPage: ''
            }
        },
        methods: {

            loadPreviousPage() {
                if (this.prevPage !== null) {
                    return axios.get(this.prevPage).then(response => {
                        this.$store.commit(this.mutator, response.data)
                        this.setButtons(response.data.meta)
                        this.setPagination(response.data.links)
                    })
                }
            },
            loadNextPage() {
                if (this.nextPage !== null) {
                    return axios.get(this.nextPage).then(response => {
                        this.$store.commit(this.mutator, response.data)
                        this.setButtons(response.data.meta)
                        this.setPagination(response.data.links)
                    })
                }
            },
            setPagination(links) {
                this.nextPage = links.next
                this.prevPage = links.prev
            },
            setButtons(meta) {
                if (meta.from === 1) {
                    this.onFirstPage = true
                } else {
                    this.onFirstPage = false

                }
                if (meta.to === meta.total) {
                    this.onLastPage = true
                } else {
                    this.onLastPage = false
                }
            }
        },
        computed: {}

    }
</script>