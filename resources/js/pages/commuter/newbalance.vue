<template>
    <div class="container pt-5 px-5" id="window">
        <span id="subheader" class="is-size-4 text-centered">E-wallet</span>
        <div class="container is-flex is-flex-direction-column mt-6">
            <div class="is-flex is-flex-direction-column">
                <p>Balance: <b>PHP {{ parseFloat(newBalance - addedValue).toFixed(2) }}</b></p>
                <p>Added Value: <b>PHP {{ addedValue }}</b></p>
                <p>Total: <b>PHP {{ newBalance }}</b></p>
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
