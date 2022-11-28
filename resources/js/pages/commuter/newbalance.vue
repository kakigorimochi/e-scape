<template>
    <div class="container pt-6 px-6">
        <div class="is-flex is-flex-direction-column">
            <p>Balance: <b>PHP {{ newBalance - addedValue }}</b></p>
            <p>Added Value: <b>PHP {{ addedValue }}</b></p>
            <p>Total: <b>PHP {{ newBalance }}</b></p>
        </div>
        <div class="container is-flex is-justify-content-end p-3">
            <b-button class="mr-3" @click="index"
                :loading="isLoading" type="is-success">Done</b-button>
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
    props: {
        addedValue: Number,
        newBalance: Number
    },
    methods: {
        index() {
            this.isLoading = true;
            window.location = '/commuter/index';
        }
    }
}
</script>
