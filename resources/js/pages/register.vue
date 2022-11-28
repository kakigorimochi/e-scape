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
            <div class="mb-3">
                <b-field grouped>
                    <b-field label="Firstname" expanded>
                        <b-input v-model="user.firstname"
                        placeholder="e.g. Juan"></b-input>
                    </b-field>
                    <b-field label="Lastname" expanded>
                        <b-input v-model="user.lastname"
                        placeholder="e.g. De La Cruz"></b-input>
                    </b-field>
                </b-field>
            </div>
            <div class="mb-3">
                <b-field label="Birthdate">
                    <datetime v-model="user.birthdate"
                        input-class="input"
                        placeholder="e.g. Jan 01, 2004"
                        type="date"
                        value-zone="Asia/Manila"
                        :week-start="7">
                    </datetime>
                </b-field>
            </div>
            <div class="mb-3">
                <b-field label="Email">
                    <b-input v-model="user.email"
                    type="email" placeholder="e.g. sample@email.com"></b-input>
                </b-field>
            </div>
            <div class="mb-3">
                <b-field label="Mobile">
                    <b-input v-model="user.phone"
                    placeholder="e.g. 09112345678"></b-input>
                </b-field>
            </div>
            <div class="mb-3">
                <b-field label="Password" id="password">
                    <b-input v-model="user.password" type="password"
                    placeholder="•••••••••••" password-reveal></b-input>
                </b-field>
            </div>
            <div class="mb-3">
                <b-button class="is-pulled-right" @click="register" id="register"
                :loading="isSubmitLoading" type="is-success">Register</b-button>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
export default {
    data () {
        return {
            isSubmitLoading: false,
            user: {
                firstname: null,
                lastname: null,
                birthdate: null,
                email: null,
                phone: null,
                password: null
            }
        };
    },
    props: {
        userType: String,
    },
    computed: {
        selectedBirthdate() {
            return this.user.birthdate ? this.user.birthdate.toDateString() : ''
        }
    },
    methods: {
        register() {
            this.isSubmitLoading = true;
            this.user.birthdate = moment(this.user.birthdate).format('YYYY-MM-DD');
            axios({
                method: 'POST',
                type: 'JSON',
                url: '/' + this.userType + '/register_user',
                data: this.user
            }).then(response => {
                this.isSubmitLoading = false;
                this.$buefy.dialog.alert({
                    message: response.data.text,
                    type: 'is-success'
                });
                if (response.data.status ==1)
                    window.location = '/' + this.userType;
            }).catch(error => {
                this.isSubmitLoading = false;
                this.$root.defaultError();
            })
        }
    }
}
</script>
