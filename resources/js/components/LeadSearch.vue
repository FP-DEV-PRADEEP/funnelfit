<template>
    <div class="lead-search-component">
        <ais-instant-search
            :search-client="searchClient"
            index-name="calendlies"
        >
            <div>
                <ais-configure
                    :hits-per-page.camel="18"
                />
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">&nbsp;</label>
                            <ais-search-box placeholder="Search here…" class="searchbox" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">Booking Date</label>
                            <AlgoliaDateFilter attribute="start_time_timestamp" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">Lead Submission Date</label>
                            <AlgoliaDateFilter attribute="created_at_timestamp" />
                        </div>
                    </div>
                </div>

                <ais-hits>
                    <template v-slot="{ items, sendEvent }">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                            <div class="col mb-4" v-for="item in items" :key="item.objectID">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ item.employee_name }}</h5>
                                        <p class="card-text">
                                            <div>
                                                <li><span class="font-weight-bold">Gym Location:</span> {{ item.gym_name }}</li>
                                                <li><span class="font-weight-bold">Lead Submission Date:</span> {{ formatTimestampToDate(item.created_at_timestamp) }}</li>
                                                <li><span class="font-weight-bold">Booking Date:</span> {{ formatTimestampToDate(item.start_time_timestamp) }}</li>
                                                <li><span class="font-weight-bold">Phone Number:</span> {{ item.employee_phone }}</li>
                                                <li><span class="font-weight-bold">Marketing Funnel Completeness:</span> 10%</li>
                                            </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </ais-hits>
                <ais-pagination />

            </div>

        </ais-instant-search>
    </div>
</template>

<style scoped>

</style>
<script>
    import algoliasearch from 'algoliasearch/lite';
    import 'instantsearch.css/themes/algolia-min.css';
    const dayjs = require('dayjs')
    import AlgoliaDateFilter from './AlgoliaDateFilter.vue'

    export default {
        components: {
            AlgoliaDateFilter
        },
        data() {
            return {
                searchClient: algoliasearch(
                    process.env.MIX_ALGOLIA_APP_ID,
                    process.env.MIX_ALGOLIA_SEARCH
                ),
            }
        },
        mounted() {
        },
        methods: {
            formatTimestampToDate(timestamp) {
                return dayjs.unix(timestamp).format('MM/DD/YYYY')
            }
        }
    }
</script>
