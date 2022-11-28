<template>
    <div class="container pt-6 px-6">
        <span class="is-size-1">E-wallet</span>
        <div class="container is-flex is-flex-direction-column mt-6 pb-6">
            <b-field class="mb-5" label="Balance">
                <b-input v-model="balance" disabled></b-input>
            </b-field>
            <div class="mb-5">
                <b-button class="is-medium is-fullwidth" @click="topup"
                    :loading="isAddValueLoading" type="is-success">Add value</b-button>
            </div>
            <div class="mb-5">
                <b-button class="is-medium is-fullwidth"
                    @click="home" type="is-success is-light">Back</b-button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            isAddValueLoading: false,
            isPaymentVisible: false,
            balance: this.currentBalance,
            modeOfPayment: 'e-scape'
        };
    },
    props: {
        currentBalance: Number
    },
    methods: {
        topup() {
            this.isAddValueLoading = true;
            window.location = '/commuter/topup';
        },
        home() {
            window.location = '/commuter/index';
        }
    }
}
</script>
