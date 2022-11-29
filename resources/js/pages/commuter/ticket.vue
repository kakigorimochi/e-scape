<template>
    <div class="container pt-6 px-6">
        <div class="container is-flex is-flex-direction-column mt-4 pb-6">
            <div class="mb-6">
                <b-field>
                    <b-radio-button v-model="originType" expanded :native-value="0"
                        type="is-success is-light is-outlined">
                        <span>North Bound</span>
                    </b-radio-button>
                    <b-radio-button v-model="originType" expanded :native-value="1"
                        type="is-success is-light is-outlined">
                        <span>South Bound</span>
                    </b-radio-button>
                </b-field>
            </div>
            <span class="is-size-3 mb-3">Single Journey Ticket (Origin)</span>
            <div class="mb-5">
                <b-select v-model="originID" expanded placeholder="Please select.">
                    <option v-for="(item, index) in locations" :key="index"
                        :label="item.name" :value="item.id"></option>
                </b-select>
            </div>
            <span class="is-size-3 mb-3">Single Journey Ticket (Destination)</span>
            <div class="mb-5">
                <b-select v-model="destinationID" expanded placeholder="Please select.">
                    <option v-for="(item, index) in destinations" :key="index"
                        :label="item.name" :value="item.id"></option>
                </b-select>
            </div>
            <div class="mb-5">
                <b-button class="is-medium is-fullwidth"
                    @click="submitJourney" type="is-success">Proceed</b-button>
            </div>
            <div class="mb-5">
                <b-button class="is-medium is-fullwidth"
                    @click="index" type="is-success is-light">Back</b-button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            isSubmitJorneyLoading: false,
            originType: null,
            originID: null,
            destinationID: null
        };
    },
    computed: {
        destinations() {
            let arr = this.originType == 1
                ? this.locations
                : this.locations.map((e, i, a) => a[(a.length -1) -i]);
            return this.originID
                ? arr.filter(item => {
                    return item.id.toString() != this.originID.toString()
                }) : arr;
        }
    },
    props: {
        locations: Array
    },
    watch: {
        originType(value) {
            var index = -1;
            if (value == 0) index = this.$root.arrayFind(this.locations, item => item.name === 'PITX');
            else index = this.$root.arrayFind(this.locations, item => item.name === 'Monumento');
            this.originID = this.locations[index].id;
        }
    },
    methods: {
        submitJourney() {
            this.isSubmitJorneyLoading = true;
            axios({
                method: 'POST',
                type: 'JSON',
                url: '/commuter/submit_journey',
                data: { origin_id: this.originID,
                    destination_id: this.destinationID,
                    origin_type: this.originType }
            }).then(response => {
                this.isSubmitJorneyLoading = false;
                if (response.data.status == 1)
                    window.location = '/commuter/pay_journey';
            }).catch(error => {
                this.isSubmitJorneyLoading = false;
                this.$root.defaultError();
            });
        },
        index() {
            window.location = '/commuter/index';
        }
    }
}
</script>
