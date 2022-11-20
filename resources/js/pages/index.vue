<template>
    <div class="container pt-6 px-6">
        <span class="is-size-1">Hello {{ userType }}!</span>
        <div class="container is-flex is-flex-direction-column mt-6 pb-6">
            <div class="mb-3">
                <b-button @click="login" type="is-info">Login</b-button>
            </div>
            <div>
                <b-button @click="register" type="is-info is-light">Register</b-button>
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
        userType: String,
    },
    methods: {
        login() {
            window.location = '/' + this.userType + '/login';
        },
        register() {
            window.location = '/' + this.userType + '/register';
        }
    }
}
</script>
