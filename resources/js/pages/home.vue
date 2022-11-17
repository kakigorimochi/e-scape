<template>
    <div class="container">
        <h1>HOME</h1>
        <div class="container">
            <b-button @click="login('commuter')" type="is-info">Commuter</b-button>
            <b-button @click="login('operator')" type="is-info is-light">Operator</b-button>
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
