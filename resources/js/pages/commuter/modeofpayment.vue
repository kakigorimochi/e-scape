<template>
    <div class="container pt-6 px-6">
        <b-field label="Mode of Payment">
            <b-radio v-model="modeOfPayment" native-value="e-scape"
                type="is-success">E-scape wallet</b-radio>
        </b-field>
        <b-field>
            <b-radio v-model="modeOfPayment" native-value="gcash"
                type="is-success">GCash</b-radio>
        </b-field>
        <b-field>
            <b-radio v-model="modeOfPayment" native-value="bank_transfer"
                type="is-success">Bank Transfer</b-radio>
        </b-field>
        <div class="container is-flex is-justify-content-end p-3">
            <b-button class="mr-3" @click="eWallet" :loading="isCancelTransactionLoading">Cancel</b-button>
            <b-button @click="proceed" :loading="isAddValueLoading" type="is-success">Proceed</b-button>
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
