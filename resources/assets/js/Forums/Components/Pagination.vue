<template>
    <div class="">
        <nav v-show="paginate" class="pagination is-rounded" role="navigation" aria-label="pagination">
            <a class="pagination-previous" :disabled="onFirstPage" @click="loadPreviousPage">Previous {{paginationText}}</a>
            <a class="pagination-next" :disabled="onLastPage" @click.prevent="loadNextPage">Next {{paginationText}}</a>
        </nav>
    </div>
</template>

<script>
    export default {
        props: ['mainData','nextPageCommitMessage','previousPageCommitMessage','paginationText'],
       created() {
            console.log("metaface",this.mainData);
            this.setButtons(this.mainData.meta)
            this.setPagination(this.mainData.links)
        },
        data() {
            return {
                paginate: true,
                onFirstPage: false,
                onLastPage: false,
                pageUrl: '',
                nextPage: '',
                prevPage: '',
            }
        },
        methods: {
            loadPreviousPage() {
                if (this.prevPage !== null) {
                    return axios.get(this.prevPage).then(response => {
                        this.$store.commit(this.previousPageCommitMessage, response.data)
                        this.setButtons(response.data.meta)
                        this.setPagination(response.data.links)
                    })
                }
            },
            loadNextPage() {
                if (this.nextPage !== null) {
                    return axios.get(this.nextPage).then(response => {
                        this.$store.commit(this.nextPageCommitMessage, response.data)
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