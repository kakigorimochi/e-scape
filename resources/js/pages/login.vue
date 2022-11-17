<template>
    <div class="container">
        <h1>Login {{ userType }}!</h1>
        <div class="container">
            <b-button @click="login" type="is-info">Login</b-button>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {};
    },
    props: {
        userType: String,
    },
    methods: {
        login() {
            window.location = '/' + this.userType + '/login';
        }
    }
}
</script>
