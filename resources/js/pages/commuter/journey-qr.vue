<template>
    <div class="container pt-6 px-6">
	    <qr-code :size="300" :text="uuid"/>
        <div class="container is-flex is-flex-direction-column mt-6 pb-6">
            <div class="is-flex is-justify-content-end mb-5">
                <span>Payment: PHP {{ journey.amount }}</span>
            </div>
            <div class="is-flex is-justify-content-end mb-5">
                <span>Balance: PHP {{ wallet.balance }}</span>
            </div>
            <div class="is-flex is-justify-content-end mb-5">
                <span>{{ dateNow }}</span>
            </div>
            <div class="mb-5">
                <b-button class="is-medium is-fullwidth"
                    @click="index" type="is-success">Done</b-button>
            </div>
            <div class="mb-5">
                <b-button class="is-medium is-fullwidth"
                    @click="cancel" type="is-success is-light">Cancel</b-button>
            </div>
        </div>
	</div>
</template>

<script>
import vueqr from 'vue-qr';
import moment from 'moment';
export default {
	components: {
        'qr-code': vueqr
	},
    data () {
        return {
            isPaymentLoading: false,
            isPaymentVisible: false,
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
        index() {
            window.location = '/commuter/index';
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