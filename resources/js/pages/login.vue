<template>
    <div class="container pt-6 px-6">
        <div class="is-flex is-justify-content-center">
            <div class="is-flex is-flex-direction-column">
                <figure class="image mt-3 mx-auto is-96x96">
                    <img src="/img/e-logo.png">
                </figure>
                <span id="title" class="is-size-2">E-scape</span>
                <span id="usertype" class="has-text-centered is-size-5">{{ userType }}</span>
            </div>
        </div>
        <div class="container is-flex is-flex-direction-column mt-6 pb-6">
            <div class="mb-3">
                <b-field label="E-mail">
                    <b-input v-model="email"></b-input>
                </b-field>
            </div>
            <div class="mb-3">
                <b-field label="Password">
                    <b-input v-model="password" type="password"></b-input>
                </b-field>
            </div>
            <div class=" mb-3">
                <b-button id="login" @click="login" type="is-success" class="is-pulled-right">Login</b-button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            isLoading: false,
            email: null,
            password: null
        };
    },
    props: {
        userType: String,
    },
    methods: {
        login() {
            this.isLoading = true;
            axios({
                method: 'POST',
                type: 'JSON',
                url: '/login',
                data: {
                    email: this.email,
                    password: this.password,
                    user_type: this.userType
                }
            }).then(response => {
                this.isLoading = false;
                this.$buefy.dialog.alert(response.data.text);
                window.location = response.data.redirect;
            }).catch(error => {
                this.isLoading = false;
                this.$root.defaultError();
            })
        }
    }
}
</script>
