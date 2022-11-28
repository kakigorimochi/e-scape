<template>
    <div class="container pt-6 px-3">
        <span class="is-size-1">Dispatches</span>
        <div class="is-flex is-flex-direction-column mt-6 pb-6">
            <div class="mb-3">
                <b-table :data="dispatches" bordered
                    hoverable :mobile-cards="false">
                    <b-table-column label="EDSA Carousel Stations" v-slot="props">
                        {{ props.row.name }}
                    </b-table-column>
                    <b-table-column label="No. of tickets bought" v-slot="props">
                        {{ props.row.tickets }}
                    </b-table-column>
                </b-table>
            </div>
            <div class="is-flex is-justify-content-end">
                <b-button class="mr-3" @click="index" type="is-success">Back</b-button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {};
    },
    props: {
        dispatches: Array,
    },
    methods: {
        index() {
            window.location = '/operator/index';
        }
    }
}
</script>
