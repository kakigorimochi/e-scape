<template>
    <div class="container pt-5 px-5" id="window">
        <span id="subheader" class="is-size-4 text-centered">Mode of Payment</span>
        <div class="container is-flex is-flex-direction-column mt-6 mb-3">
            <div id="mopgroup">
                <b-field>
                    <b-radio v-model="modeOfPayment" native-value="pay_cash"
                    :style="[modeOfPayment === 'pay_cash' ? {'font-weight': 600} : {}]"
                    type="is-success">Pay with Cash</b-radio>
                </b-field>
                <b-field>
                    <b-radio v-model="modeOfPayment" native-value="gcash"
                    :style="[modeOfPayment === 'gcash' ? {'font-weight': 600} : {}]"
                    type="is-success">GCash E-wallet</b-radio>
                </b-field>
                <b-field>
                    <b-radio v-model="modeOfPayment" native-value="bank_transfer"
                    :style="[modeOfPayment === 'bank_transfer' ? {'font-weight': 600} : {}]"
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
            modeOfPayment: 'pay_cash'
        };
    },
    methods: {
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
