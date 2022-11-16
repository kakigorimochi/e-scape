<template>
    <div>
        <h1>HOME</h1>
        <b-button @click="login('commuter')" type="is-info">Commuter</b-button>
        <b-button @click="login('operator')" type="is-info is-light">Operator</b-button>
    </div>
</template>

<script>
export default {
    data () {
        return {}
    },
    methods: {
        login(userType) {
            window.location = '/' + userType
        }
    }
}
</script>
