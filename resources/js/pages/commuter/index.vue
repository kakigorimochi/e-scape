<template>
    <div class="container pt-6 px-6">
        <div class="is-flex is-justify-content-center">
            <div class="is-flex is-flex-direction-column">
                <figure class="image mt-3 mx-auto is-64x64">
                    <img src="/img/e-logo.png">
                </figure>
                <span id="title" class="is-size-3">E-scape</span>
                <span class="has-text-centered is-size-6">Good day, {{ info.fname + ' ' + info.lname }}</span>
            </div>
        </div>
        <div class="container is-flex is-flex-direction-column mt-3 pb-3">
            <div class="mt-5">
                <b-button id="sjticket" class="is-medium is-fullwidth"
                @click="sjt" type="is-success">Single Journey Ticket</b-button>
            </div>
            <div class="mt-5">
                <b-button id="wallet" class="is-medium is-fullwidth"
                @click="eWallet" type="is-success">E-wallet</b-button>
            </div>
            <div class="mt-5">
                <b-button id="rewards" class="is-medium is-fullwidth"
                type="is-success" disabled>Rewards</b-button>
            </div>
            <div class="mt-5">
                <b-button id="logout" class="is-medium is-fullwidth"
                @click="logout" type="is-success is-light">Logout</b-button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {};
    },
    props: {
        info: Object,
        journey: Boolean
    },
    methods: {
        eWallet() {
            window.location = '/commuter/e-wallet';
        },
        sjt() {
            if (this.journey) window.location = '/commuter/pay_journey';
            else window.location = '/commuter/single-journey-ticket';
        },
        logout() {
            axios.get('/logout').then(() => {
                window.location = '/';
            });
        }
    }
}
</script>
