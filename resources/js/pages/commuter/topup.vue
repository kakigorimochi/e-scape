<template>
    <div class="container pt-5 px-5" id="window">
        <span id="subheader" class="is-size-4 text-centered">Add Value</span>
        <div class="container is-flex is-flex-direction-column mt-6">
            <b-field id="balance" class="mb-3" label="Enter Amount:" message="Enter a value minimum of PHP 20 or choose one of the amount values below.">
                <p class="control" id="currency">
                    <span class="button is-static">PHP</span>
                </p>
                <b-input id="amount" type="decimal" v-model="value" :min="20" @change.native="formatValue"></b-input>
            </b-field>
            <b-field id="presetgroup" grouped group-multiline>
                <p class="control">
                    <b-radio-button id="presetvalue" v-model="presetValue" :native-value="20"
                    type="is-success is-light is-outlined">
                        <span>20</span>
                    </b-radio-button>
                </p>
                <p class="control">
                    <b-radio-button id="presetvalue" v-model="presetValue" :native-value="50"
                    type="is-success is-light is-outlined">
                        <span>50</span>
                    </b-radio-button>
                </p>
                <p class="control">
                    <b-radio-button id="presetvalue" v-model="presetValue" :native-value="100"
                    type="is-success is-light is-outlined">
                        <span>100</span>
                    </b-radio-button>
                </p>
                <p class="control">
                    <b-radio-button id="presetvalue" v-model="presetValue" :native-value="200"
                    type="is-success is-light is-outlined">
                        <span>200</span>
                    </b-radio-button>
                </p>
                <p class="control">
                    <b-radio-button id="presetvalue" v-model="presetValue" :native-value="500"
                    type="is-success is-light is-outlined">
                        <span>500</span>
                    </b-radio-button>
                </p>
                <p class="control">
                    <b-radio-button id="presetvalue" v-model="presetValue" :native-value="1000"
                    type="is-success is-light is-outlined">
                        <span>1000</span>
                    </b-radio-button>
                </p>
            </b-field>
            <div class="mb-4">
                <b-button id="proceed" class="is-medium is-fullwidth"
                @click="addValue" :disabled="value < 20"
                :loading="isAddValueLoading" type="is-success">Proceed</b-button>
            </div>
            <div class="mb-5">
                <b-button id="back" class="is-medium is-fullwidth"
                @click="eWallet" type="is-success">Cancel</b-button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            isAddValueLoading: false,
            modeOfPayment: 'e-scape',
            presetValue: 0.00,
            value: 0.00
        };
    },
    props: {
        info: Object,
        journey: Boolean
    },
    watch: {
        presetValue(value) {
            this.value = parseFloat(value).toFixed(2);
            // this.addValue();
        }
    },
    mounted() {
        this.value = parseFloat(0).toFixed(2);
    },
    methods: {
        formatValue() {
            this.value = (this.value != '') ? parseFloat(this.value).toFixed(2) : parseFloat(0).toFixed(2);
        },
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

