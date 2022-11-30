<template>
    <div class="container pt-5 px-5" id="window">
        <span id="subheader" class="is-size-4 text-centered">E-wallet</span>
        <div class="container is-flex is-flex-direction-column mt-6">
            <div class="is-flex is-flex-direction-column">
                <b-field label="Balance">
                    <p class="control" id="currency">
                        <span class="button is-static">PHP</span>
                    </p>
                    <b-input disabled :value="parseFloat(newBalance - addedValue).toFixed(2)"></b-input>
                </b-field>
                <b-field label="Added Value">
                    <p class="control" id="currency">
                        <span class="button is-static">PHP</span>
                    </p>
                    <b-input disabled :value="addedValue"></b-input>
                </b-field>
                <b-field label="Total">
                    <p class="control" id="currency">
                        <span class="button is-static">PHP</span>
                    </p>
                    <b-input disabled :value="newBalance"></b-input>
                </b-field>
            </div>
            <div class="mb-5">
                <b-button id="back" class="is-medium is-fullwidth"
                @click="index" :loading="isLoading" type="is-success">Done</b-button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            isLoading: false,
        };
    },
    props: ['addedValue', 'newBalance'],
    methods: {
        index() {
            this.isLoading = true;
            window.location = '/commuter/index';
        }
    }
}
</script>
