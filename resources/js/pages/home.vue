<template>
    <div class="container pt-6 px-6">
        <div class="is-flex is-justify-content-center">
            <div class="is-flex is-flex-direction-column">
                <figure class="image mt-6 mx-auto is-96x96">
                    <img src="/img/e-logo.png">
                </figure>
                <span id="title" class="is-size-2">E-scape</span>
            </div>
        </div>
        <div class="container is-flex is-flex-direction-column mt-6 pb-6">
            <div class="mt-5 mb-5"><b-button id="comm" @click="login('commuter')" type="is-success" class="is-medium is-fullwidth">Commuter</b-button></div>
            <div><b-button id="optr" @click="login('operator')" type="is-success is-light" class="is-medium is-fullwidth">Operator</b-button></div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {};
    },
    methods: {
        login(userType) {
            window.location = '/' + userType;
        }
    }
}
</script>
