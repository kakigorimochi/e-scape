<template>
    <div class="container pt-6 px-6">
        <span class="is-size-1">E-wallet</span>
        <div class="container is-flex is-flex-direction-column mt-6 pb-6">
            <b-field class="mb-5" label="Balance">
                <b-input v-model="balance" disabled></b-input>
            </b-field>
            <div class="mb-5">
                <b-button class="is-medium is-fullwidth"
                    @click="isAddValueVisible = true" type="is-success">Add value</b-button>
            </div>
            <div class="mb-5">
                <b-button class="is-medium is-fullwidth"
                    @click="home" type="is-success is-light">Back</b-button>
            </div>
        </div>
        <b-modal v-model="isAddValueVisible" :can-cancel="false" :width="480">
            <div class="card">
                <div class="card-content">
                    <section class="modal-card-body">
                        <b-field label="Amount">
                            <b-numberinput v-model="value" controls-alignment="right"
                                type="is-success"></b-numberinput>
                        </b-field>
                    </section>
                </div>
                <footer class="is-flex is-justify-content-end modal-card-foot">
                    <b-button class="mr-3" @click="isAddValueVisible = false">Close</b-button>
                    <b-button @click="addValue" :loading="isAddValueLoading" type="is-success">Proceed</b-button>
                </footer>
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
            balance: this.currentBalance,
            value: 0.00
        };
    },
    props: {
        currentBalance: Number
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
                this.isAddValueVisible = false;
                this.$buefy.dialog.alert({
                    message: response.data.text,
                    type: 'is-success'
                });
                this.balance = response.data.new_balance;
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
