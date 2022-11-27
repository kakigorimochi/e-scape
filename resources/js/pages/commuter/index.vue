<template>
    <div class="container pt-6 px-6">
        <div class="is-flex is-justify-content-center">
            <div class="is-flex is-flex-direction-column">
                <figure class="image mt-6 mx-auto is-96x96">
                    <img src="/img/e-logo.png">
                </figure>
                <span class="is-size-2">E-scape</span>
            </div>
        </div>
        <div class="container is-flex is-flex-direction-column mt-6 pb-6">
            <span class="is-size-3 mb-6">Hello {{ info.fname + ' ' + info.lname }}!</span>
            <div class="mb-5">
                <b-button class="is-medium is-fullwidth"
                    @click="sjt" type="is-success">Single Journey Ticket</b-button>
            </div>
            <div class="mb-5">
                <b-button class="is-medium is-fullwidth"
                    @click="eWallet" type="is-success">E-wallet</b-button>
            </div>
            <div class="mb-5">
                <b-button class="is-medium is-fullwidth"
                    type="is-success">Rewards</b-button>
            </div>
            <div class="mb-5">
                <b-button class="is-medium is-fullwidth"
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
