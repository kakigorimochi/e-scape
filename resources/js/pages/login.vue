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
            <form @keyup.enter="login">
                <div class="mb-3">
                    <b-field label="E-mail">
                        <b-input v-model="email"
                        type="email" placeholder="e.g. sample@email.com"></b-input>
                    </b-field>
                </div>
                <div class="mb-3">
                    <b-field label="Password">
                        <b-input v-model="password" type="password"
                        placeholder="•••••••••••" password-reveal></b-input>
                    </b-field>
                </div>
                <div class="mb-5">
                    <b-button class="is-pulled-right" @click="login" id="login"
                    :loading="isLoading" type="is-success">Login</b-button>
                </div>
            </form>
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
                this.$buefy.dialog.alert({
                    message: response.data.text,
                    type: 'is-success'
                });
                if (response.data.status == 1)
                    window.location = response.data.redirect;
            }).catch(error => {
                this.isLoading = false;
                this.$root.defaultError();
            });
        }
    }
}
</script>
