<template>
    <div class="container pt-6 px-6">
        <span class="is-size-1">Home</span>
        <div class="container is-flex is-flex-direction-column mt-6 pb-6">
            <div class="mb-3">
                <b-button @click="login('commuter')" type="is-info">Commuter</b-button>
            </div>
            <div>
                <b-button @click="login('operator')" type="is-info is-light">Operator</b-button>
            </div>
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
