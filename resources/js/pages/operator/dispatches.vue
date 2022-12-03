<template>
    <div class="container pt-3 px-5">
        <span id="subheader" class="is-size-4 text-centered">Bus Dispatch <br><p>{{ time }}</p></span>
        <div class="is-flex is-flex-direction-column mt-5">
            <div id="dispatchtable" class="mt-3 mb-3">
                <b-table :data="dispatches" narrowed :mobile-cards="false">
                    <b-table-column label="EDSA Carousel Stations" v-slot="props">
                        <b-checkbox v-model="selectedLocations" type="is-success"
                        :class="{'has-text-weight-bold': locationSelected(props.row.id)}"
                        :native-value="props.row.id" :disabled="!props.row.tickets">
                            {{ props.row.name }}
                        </b-checkbox>
                    </b-table-column>
                    <b-table-column label="No. of tickets bought" v-slot="props" :style="'text-align: right'">
                        <p :class="{'has-text-weight-bold': locationSelected(props.row.id)}"
                        :style="[!props.row.tickets ? {'opacity': 0.5} : {}]">
                        {{ Number(props.row.tickets ? props.row.tickets : 0).toLocaleString() }} &nbsp;ticket/s
                        </p>
                    </b-table-column>
                </b-table>
            </div>
            <div class="mb-5">
                <b-button id="dispatch" class="is-medium is-fullwidth" @click="dispatch"
                    :disabled="selectedLocations.length == 0" :loading="isDispatchLoading" type="is-success">Dispatch</b-button>
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
            isDispatchLoading: false,
            time: '',
            selectedLocations: []
        };
    },
    props: {
        dispatches: Array
    },
    mounted() {
        this.time = this.printtime();
    },
    methods: {
        locationSelected(id) {
            return this.selectedLocations.includes(id);
        },
        dispatch() {
            this.isDispatchLoading = true;
            axios({
                method: 'POST',
                type: 'JSON',
                url: '/operator/dispatch_tickets',
                data: { locations: this.selectedLocations }
            }).then(response => {
                this.isDispatchLoading = false;
                this.$root.prompt(response.data.text);
                if (response.data.status == 1) {
                    this.selectedLocations = [];
                    this.dispatches = response.data.dispatches;
                }
            }).catch(error => {
                this.isDispatchLoading = false;
                this.$root.prompt();
            });
        },
        printtime() {
            return new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        },
        index() {
            window.location = '/operator/index';
        }
    }
}
</script>
