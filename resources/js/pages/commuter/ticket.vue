<template>
    <div class="container pt-6 px-6">
        <div class="container is-flex is-flex-direction-column mt-6 pb-6">
            <span class="is-size-3 mb-6">Single Journey Ticket (Origin)</span>
            <div class="mb-5">
                <b-select v-model="originID" expanded placeholder="Please select.">
                    <option v-for="(item, index) in locations" :key="index"
                        :label="item.name" :value="item.id"></option>
                </b-select>
            </div>
            <span class="is-size-3 mb-6">Single Journey Ticket (Destination)</span>
            <div class="mb-5">
                <b-select v-model="destinationID" expanded placeholder="Please select.">
                    <option v-for="(item, index) in locations" :key="index"
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
            originID: this.locations[0].id,
            destinationID: this.locations[0].id
        };
    },
    props: {
        locations: Array
    },
    methods: {
        submitJourney() {
            this.isSubmitJorneyLoading = true;
            axios({
                method: 'POST',
                type: 'JSON',
                url: '/commuter/submit_journey',
                data: { origin_id: this.originID,
                    destination_id: this.destinationID }
            }).then(response => {
                this.isSubmitJorneyLoading = false;
                if (response.data.status == 1)
                    window.location = '/commuter/pay_journey';
            }).catch(error => {
                this.isSubmitJorneyLoading = false;
                this.$root.defaultError();
            })
        },
        index() {
            window.location = '/commuter/index';
        }
    }
}
</script>
