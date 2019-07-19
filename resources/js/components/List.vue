<template>
    <loader :ready="ready">
        <div id="defaultList">
            <div id="listItems" v-if="items && items.length>0">
                <template v-for="item in items">
                    <slot
                        name="item"
                        class="testDefaultList"
                        v-bind:item="item"
                    ></slot>
                </template>
            </div>
            <div class="alert alert-danger" role="alert" v-else>
                No items found
            </div>
            <ul class="pagination" v-if="pages.length>1">
                <li class="page-item" v-if="pages[0]!==1">
                    <a class="page-link" @click.prevent="setPage(pages[0]-1)">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <template v-for="page in pages">
                    <li class="page-item" v-bind:class="{active:page===currentPage}">
                        <a class="page-link" href="#" @click.prevent="setPage(page)">{{ page }}</a>
                    </li>
                </template>
                <li class="page-item" v-if="pages[pages.length-1]!==totalPages">
                    <a class="page-link" href="#" @click.prevent="setPage(pages[pages.length-1]+1)">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </div>
    </loader>
</template>

<script>
    const PAGES_LEFT_RIGHT = 2;
    // noinspection JSUnusedGlobalSymbols
    export default {
        props: {
            resource: {
                type: String,
                required: true,
            },
        },
        data() {
            return {
                currentPage: 1,
                totalPages: null,
                pages: [],
                items: null,
                ready: false,
            };
        },
        methods: {
            reload() {
                this.ready = false;
                this.axios.get(`api/${this.resource}`, {
                    params: {
                        page: this.currentPage,
                    },
                }).then(
                    /**
                     * @typedef {Object} ListMeta
                     * @property {number} current_page
                     * @property {number} last_page
                     */
                    
                    /**
                     * @param {Object} response
                     * @param {Array} response.data
                     * @param {Object} response.links
                     * @param {ListMeta} response.meta
                     */
                    ({data: response}) => {
                        this.ready = true;
                        this.currentPage = response.meta.current_page;
                        this.totalPages = response.meta.last_page;
                        this.pages = [];
                        for (
                            let i = Math.max(1, this.currentPage - PAGES_LEFT_RIGHT);
                            i <= Math.min(this.totalPages, this.currentPage + PAGES_LEFT_RIGHT);
                            i++
                        ) {
                            this.pages.push(i);
                        }
                        this.items = response.data;
                    },
                    this.$errorsCatcher.bind(this),
                );
            },
            setPage(pageNumber) {
                this.currentPage = pageNumber;
                this.reload();
                return false;
            },
        },
        mounted() {
            this.reload();
        },
    }
</script>

<style lang="scss">
    #listItems {
        display: flex;
        flex-wrap: wrap;
        margin: -5px;
        
        .item {
            margin: 5px;
            border: 3px solid #242939;
            border-radius: 4px;
            padding: 5px;
            
            p {
                margin: 0;
            }
            
            .actions {
                text-align: center;
            }
        }
    }
</style>
