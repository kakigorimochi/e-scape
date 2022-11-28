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
                <b-button id="addvalue" class="is-medium is-fullwidth"
                    @click="isAddValueVisible = true" type="is-success">Add Value</b-button>
            </div>
            <div class="mb-5">
                <b-button id="back" class="is-medium is-fullwidth"
                    @click="home" type="is-success">Back</b-button>
            </div>
        </div>
        <b-modal v-model="isAddValueVisible" :can-cancel="false" full-screen :width="480">
            <div class="container p-6">
                <div class="is-flex is-justify-content-center mb-3">
                    <b-field grouped group-multiline>
                        <p class="control">
                            <b-radio-button v-model="newValue" :native-value="20"
                                size="is-small" type="is-success is-light is-outlined">
                                <span>20</span>
                            </b-radio-button>
                        </p>
                        <p class="control">
                            <b-radio-button v-model="newValue" :native-value="50"
                                size="is-small" type="is-success is-light is-outlined">
                                <span>50</span>
                            </b-radio-button>
                        </p>
                        <p class="control">
                            <b-radio-button v-model="newValue" :native-value="100"
                                size="is-small" type="is-success is-light is-outlined">
                                <span>100</span>
                            </b-radio-button>
                        </p>
                        <p class="control">
                            <b-radio-button v-model="newValue" :native-value="500"
                                size="is-small" type="is-success is-light is-outlined">
                                <span>500</span>
                            </b-radio-button>
                        </p>
                        <p class="control">
                            <b-radio-button v-model="newValue" :native-value="1000"
                                size="is-small" type="is-success is-light is-outlined">
                                <span>1000</span>
                            </b-radio-button>
                        </p>
                        <span class="control">
                            <b-field>
                                <p class="control">
                                    <span class="button is-small is-static">Other amount</span>
                                </p>
                                <b-numberinput v-model="value" :controls="false"
                                    controls-position="compact" :min="20" size="is-small"></b-numberinput>
                            </b-field>
                        </span>
                    </b-field>
                </div>
                <div class="is-flex is-justify-content-end">
                    <b-button class="mr-3" @click="isAddValueVisible = false">Cancel</b-button>
                    <b-button @click="isPaymentVisible = true"
                        :disabled="value < 20" type="is-success">Proceed</b-button>
                </div>
            </div>
        </b-modal>
        <b-modal v-model="isPaymentVisible" :can-cancel="false" full-screen :width="480">
            <div class="container p-6">
                <div class="container">
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
                </div>
                <div class="container is-flex is-justify-content-end p-3">
                    <b-button class="mr-3" @click="isPaymentVisible = false">Cancel</b-button>
                    <b-button @click="addValue" :loading="isAddValueLoading" type="is-success">Proceed</b-button>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    data () {
        return {
            isAddValueLoading: false,
            isAddValueVisible: false,
            isPaymentVisible: false,
            balance: this.currentBalance,
            modeOfPayment: 'e-scape',
            newValue: 0.00,
            value: 0.00
        };
    },
    props: {
        currentBalance: Number
    },
    watch: {
        newValue(value) {
            this.value = value;
            this.isPaymentVisible = true;
        }
    },
    methods: {
        addValue() {
            this.isAddValueLoading = true;
            axios({
                method: 'POST',
                type: 'JSON',
                url: '/commuter/add_wallet_balance',
                data: { value: this.value }
            }).then(response => {
                this.isAddValueLoading = false;
                this.$buefy.dialog.alert({
                    message: response.data.text,
                    type: 'is-success'
                });
                this.balance = response.data.new_balance;
                this.isAddValueVisible = false;
                this.isPaymentVisible = false;
            }).catch(error => {
                this.isAddValueLoading = false;
                this.$root.defaultError();
            })
        },
        home() {
            window.location = '/commuter/index';
        }
    }
}
</script>
