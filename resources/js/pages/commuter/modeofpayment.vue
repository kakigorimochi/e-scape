<template>
    <div class="container pt-5 px-5" id="window">
        <span id="subheader" class="is-size-4 text-centered">Mode of Payment</span>
        <div class="container is-flex is-flex-direction-column mt-6 mb-3">
            <div id="mopgroup">
                <b-field>
                    <b-radio v-model="modeOfPayment" native-value="e-scape"
                    type="is-success" @checked="eggnog">Cash-In with Driver</b-radio>
                </b-field>
                <b-field>
                    <b-radio v-model="modeOfPayment" native-value="gcash"
                    type="is-success">GCash E-wallet</b-radio>
                </b-field>
                <b-field>
                    <b-radio v-model="modeOfPayment" native-value="bank_transfer"
                    type="is-success">Bank Transfer via InstaPay</b-radio>
                </b-field>
            </div>
            <div class="mb-4">
                <b-button id="proceed" class="is-medium is-fullwidth"
                @click="proceed" :loading="isAddValueLoading" type="is-success">Confirm</b-button>
            </div>
            <div class="mb-5">
                <b-button id="back" class="is-medium is-fullwidth"
                @click="eWallet" :loading="isCancelTransactionLoading" type="is-success">Cancel</b-button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            isAddValueLoading: false,
            isCancelTransactionLoading: false,
            modeOfPayment: 'e-scape'
        };
    },
    methods: {
        eggnog() {
            console.log(this.checked);
        },
        eWallet() {
            this.isCancelTransactionLoading = true;
            axios.get('/commuter/cancel_transaction').then(() => {
                window.location = '/commuter/e-wallet';
            });
        },
        proceed() {
            this.isAddValueLoading = true;
            axios.get('/commuter/pay_transaction').then(() => {
                window.location = '/commuter/new_balance';
            });
        }
    }
}
</script>
