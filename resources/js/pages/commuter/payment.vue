<template>
    <div class="container pt-6 px-6">
        <span class="is-size-1">Fare</span>
        <div class="container is-flex is-flex-direction-column mt-6 pb-6">
            <b-field class="mb-5" label="Amount">
                <b-input v-model="journey.amount" disabled></b-input>
            </b-field>
            <div class="mb-5">
                <b-button class="is-medium is-fullwidth"
                    @click="isConfirmPaymentVisible = true" type="is-success">Next</b-button>
            </div>
            <div class="mb-5">
                <b-button class="is-medium is-fullwidth"
                    @click="cancel" type="is-success is-light">Back</b-button>
            </div>
        </div>
        <b-modal v-model="isConfirmPaymentVisible" :can-cancel="false" full-screen>
            <div class="container p-6">
                <div class="is-flex is-justify-content-center mb-5">
                    <span class="is-size-3">Single Journey Ticket</span>
                </div>
                <div class="is-flex is-justify-content-center mb-5">
                    <span><b>{{ journey == 1 ? 'Southbound' : 'Northbound' }}</b></span>
                </div>
                <div class="is-flex is-justify-content-center mb-5">
                    <span class="mr-3">Origin: <b>{{ journey.origin }}</b></span>
                    <span>Destination: <b>{{ journey.destination }}</b></span>
                </div>
                <div class="is-flex is-justify-content-center mb-5">
                    <span class="is-size-3">Are you sure you want to proceed?</span>
                </div>
                <div class="is-flex is-justify-content-end">
                    <b-button class="mr-3" @click="isConfirmPaymentVisible = false" type="is-light">Cancel</b-button>
                    <b-button @click="isQRVisible = true, isConfirmPaymentVisible = false" type="is-success">Proceed</b-button>
                </div>
            </div>
        </b-modal>
        <b-modal v-model="isQRVisible" :can-cancel="false" full-screen>
            <div class="container p-6">
                <div class="is-flex is-justify-content-center mb-5">
                    <qr-code :size="300" :text="uuid"/>
                </div>
                <div class="is-flex is-justify-content-end mb-5">
                    <span>Payment: <b>PHP {{ journey.amount }}</b></span>
                </div>
                <div class="is-flex is-justify-content-end mb-5">
                    <span>New Balance: <b>PHP {{ wallet.balance - journey.amount }}</b></span>
                </div>
                <div class="is-flex is-justify-content-end mb-5">
                    <span>{{ dateNow }}</span>
                </div>
                <div class="is-flex is-justify-content-center">
                    <b-button class="is-medium" @click="payJourney"
                        :loading="isPaymentLoading" type="is-success">Done</b-button>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
import moment from 'moment';
import vueqr from 'vue-qr';
export default {
    components: {
        'qr-code': vueqr
    },
    data () {
        return {
            isConfirmPaymentVisible: false,
            isPaymentLoading: false,
            isQRVisible: false,
            dateNow: moment().format('MMMM DD'),
            modeOfPayment: 'e-scape'
        };
    },
    props: {
        journey: Object,
        uuid: String,
        wallet: Object
    },
    methods: {
        payJourney() {
            this.isPaymentLoading = true;
            axios({
                method: 'POST',
                type: 'JSON',
                url: '/commuter/journey_paid',
                data: { id: this.journey.id }
            }).then(response => {
                if (response.data.status == 1)
                    window.location = '/commuter/index';
            }).catch(error => {
                this.isPaymentLoading = false;
                this.$root.prompt();
            });
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
                this.$root.prompt();
            });
        }
    }
}
</script>
