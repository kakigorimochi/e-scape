<template>
    <div class="container pt-6 px-6">
        <span class="is-size-1">Login {{ userType }}!</span>
        <div class="container is-flex is-flex-direction-column mt-6 pb-6">
            <div class="mb-3">
                <b-field label="Email / Phone number / Username">
                    <b-input v-model="email"></b-input>
                </b-field>
            </div>
            <div class="mb-3">
                <b-field label="Password">
                    <b-input v-model="password" type="password"></b-input>
                </b-field>
            </div>
            <div class="mb-3">
                <b-button @click="login" type="is-info">Login</b-button>
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
