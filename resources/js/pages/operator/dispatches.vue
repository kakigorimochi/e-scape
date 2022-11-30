<template>
    <div class="container pt-3 px-5">
        <span id="subheader" class="is-size-4 text-centered">Bus Dispatch <br><p>{{ time }}</p></span>
        <div class="is-flex is-flex-direction-column mt-5">
            <div id="dispatchtable" class="mt-3 mb-3">
                <b-table :data="dispatches" narrowed :mobile-cards="false">
                    <b-table-column id="stations" label="EDSA Carousel Stations" v-slot="props">
                        {{ props.row.name }}
                    </b-table-column>
                    <b-table-column label="No. of tickets bought" v-slot="props" :style="'text-align: right'">
                        {{ props.row.tickets }} &nbsp;tickets
                    </b-table-column>
                </b-table>
            </div>
            <div class="mb-5">
                <b-button id="back" class="is-medium is-fullwidth"
                @click="index" type="is-success">Back</b-button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            time: ''
        };
    },
    props: {
        dispatches: Array,
    },
    mounted: function () {
        this.time = this.printtime();
    },
    methods: {
        printtime: function () {
            return new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        },
        index() {
            window.location = '/operator/index';
        }
    }
}
</script>
