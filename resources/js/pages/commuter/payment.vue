<template>
    <div class="container pt-5 px-5" id="window">
        <span id="subheader" class="is-size-4 text-centered">Fare</span>
        <div class="container is-flex is-flex-direction-column mt-6 pb-3">
            <b-field id="amount" class="mb-5" label="Amount:">
                <p class="control" id="currency">
                    <span class="button is-static">PHP</span>
                </p>
                <b-input v-model="journey.amount" disabled></b-input>
            </b-field>
            <div class="mb-5">
                <b-button id="next" class="is-medium is-fullwidth"
                @click="isConfirmPaymentVisible = true" type="is-success">Next</b-button>
            </div>
            <div class="mb-5">
                <b-button id="back" class="is-medium is-fullwidth"
                @click="cancel" type="is-success">Back</b-button>
            </div>
        </div>
        <b-modal v-model="isConfirmPaymentVisible" :can-cancel="false" full-screen>
            <div id="confirmation" class="container pt-4 px-4">
                <span id="subheader" class="is-size-4 text-centered">Journey Details <br><p>{{ journey == 1 ? 'Southbound' : 'Northbound' }}</p></span>
                <div class="is-flex is-justify-content-center mt-6">
                    <div class="has-text-centered mx-5">
                        <strong>{{ journey.origin }}</strong>
                        <br>Point of Origin
                    </div>
                </div>
                <div class="is-flex is-justify-content-center mt-4 pb-5">
                    <div class="has-text-centered mx-5">
                        <strong>{{ journey.destination }}</strong>
                        <br>Destination
                    </div>
                </div>
                <div class="mb-4">
                    <b-button id="confirm" class="is-medium is-fullwidth"
                    @click="isQRVisible = true, isConfirmPaymentVisible = false"
                    type="is-success">Confirm</b-button>
                </div>
                <div class="mb-5">
                    <b-button id="cancel" class="is-medium is-fullwidth"
                    @click="isConfirmPaymentVisible = false" type="is-success">Cancel</b-button>
                </div>
            </div>
        </b-modal>
        <b-modal v-model="isQRVisible" :can-cancel="false" full-screen>
            <div id="boarding" class="container pt-4 px-4">
                <div id="qrcode" class="is-flex is-justify-content-center mb-3">
                    <qr-code :size="384" :text="uuid"/>
                </div>
                <div id="deets" class="is-flex is-justify-content-center mt-4 pb-6">
                    <div class="column">
                        <span>Amount Paid:<br></span>
                        <span>Remaining Balance:<br></span>
                    </div>
                    <div class="column has-text-right">
                        <span><strong>PHP {{ journey.amount }}</strong><br></span>
                        <span><strong>PHP {{ wallet.balance - journey.amount }}</strong><br></span>
                        <span id="date">{{ dateNow }}</span>
                    </div>
                </div>
                <div class="mb-5">
                    <b-button id="finish" class="is-medium is-fullwidth"
                    @click="payJourney" :loading="isPaymentLoading" type="is-success">Done</b-button>
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
            dateNow: moment().format('MMMM DD, YYYY'),
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
