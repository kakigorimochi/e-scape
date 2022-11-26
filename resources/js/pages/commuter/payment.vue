<template>
    <div class="container pt-6 px-6">
        <span class="is-size-1">Fare</span>
        <div class="container is-flex is-flex-direction-column mt-6 pb-6">
            <b-field class="mb-5" label="Amount">
                <b-input v-model="journey.amount" disabled></b-input>
            </b-field>
            <div class="mb-5">
                <b-button class="is-medium is-fullwidth"
                    @click="isPaymentVisible = true" type="is-success">Next</b-button>
            </div>
            <div class="mb-5">
                <b-button class="is-medium is-fullwidth"
                    @click="cancel" type="is-success is-light">Back</b-button>
            </div>
        </div>
        <b-modal v-model="isPaymentVisible" :can-cancel="false" :width="480">
            <div class="card">
                <div class="card-content">
                    <b-field label="Mode of Payment">
                        <b-select v-model="modeOfPayment" expanded placeholder="Please select.">
                            <option label="E-scape" value="e-scape"></option>
                            <option label="GCash" value="gcash"></option>
                            <option label="Bank Transfer" value="bank_transfer"></option>
                        </b-select>
                    </b-field>
                </div>
                <footer class="is-flex is-justify-content-end modal-card-foot">
                    <b-button class="mr-3" @click="payJourney"
                        :loading="isPaymentLoading" type="is-success">Proceed</b-button>
                    <b-button @click="isPaymentVisible = false">Close</b-button>
                </footer>
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    data () {
        return {
            isPaymentLoading: false,
            isPaymentVisible: false,
            modeOfPayment: 'e-scape'
        };
    },
    props: {
        journey: Object
    },
    methods: {
        payJourney() {
            window.location = '/commuter/journey_qr';
        },
        cancel() {
            axios({
                method: 'POST',
                type: 'JSON',
                url: '/commuter/cancel_journey',
                data: { id: this.journey.id }
            }).then(response => {
                if (response.data.status == 1)
                    window.location = '/commuter/single-journey-ticket';
            }).catch(error => {
                this.$root.defaultError();
            })
        }
    }
}
</script>
