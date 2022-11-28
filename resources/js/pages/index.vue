<template>
    <div class="container pt-6 px-6">
        <div class="is-flex is-justify-content-center">
            <div class="is-flex is-flex-direction-column">
                <figure class="image mt-3 mx-auto is-64x64">
                    <img src="/img/e-logo.png">
                </figure>
                <span id="title" class="is-size-3">E-scape</span>
                <span id="usertype" class="has-text-centered is-size-6">{{ userType }}</span>
            </div>
        </div>
        <div class="container is-flex is-flex-direction-column mt-3 pb-3">
            <div class="mb-5">
                <b-button id="login" @click="login" type="is-success" class="is-medium is-fullwidth">Login</b-button>
            </div>
            <div class="mt-2">
                <b-button id="register" @click="register" type="is-success" class="is-medium is-fullwidth">Sign-Up</b-button>
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
