<template>
    <div class="container pt-5 px-5" id="window">
        <span id="subheader" class="is-size-4 text-centered">E-wallet</span>
        <div class="container is-flex is-flex-direction-column mt-6">
            <b-field id="balance" class="mb-5" label="Balance:" icon="email">
                <p class="control" id="currency">
                    <span class="button is-static">PHP</span>
                </p>
                <b-input v-model="balance" disabled></b-input>
            </b-field>
            <div class="mb-5">
                <b-button class="is-medium is-fullwidth" @click="topup"
                    :loading="isAddValueLoading" type="is-success">Add value</b-button>
            </div>
            <div class="mb-5">
                <b-button id="back" class="is-medium is-fullwidth"
                    @click="home" type="is-success">Back</b-button>
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
