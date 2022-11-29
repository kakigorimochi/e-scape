<template>
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
                    <b-radio-button v-model="newValue" :native-value="200"
                        size="is-small" type="is-success is-light is-outlined">
                        <span>200</span>
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
            <b-button class="mr-3" @click="eWallet">Cancel</b-button>
            <b-button @click="addValue" :disabled="value < 20"
                :loading="isAddValueLoading" type="is-success">Proceed</b-button>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            isAddValueLoading: false,
            modeOfPayment: 'e-scape',
            newValue: 0.00,
            value: 0.00
        };
    },
    props: {
        info: Object,
        journey: Boolean
    },
    watch: {
        newValue(value) {
            this.value = value;
            this.addValue();
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
                if (response.data.status == 1)
                    window.location = '/commuter/mode_of_payment';
                // this.isAddValueLoading = false;
            }).catch(error => {
                this.isAddValueLoading = false;
                this.$root.prompt();
            });
        },
        eWallet() {
            window.location = '/commuter/e-wallet';
        }
    }
}
</script>

