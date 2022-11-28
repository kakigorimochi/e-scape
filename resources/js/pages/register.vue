<template>
    <div class="container">
        <h1>Register {{ userType }}!</h1>
        <div class="container">
            <b-field label="Firstname">
                <b-input v-model="user.firstname"></b-input>
            </b-field>
            <b-field label="Lastname">
                <b-input v-model="user.lastname"></b-input>
            </b-field>
            <b-field label="Birthdate">
                <datetime v-model="user.birthdate"
                    input-class="input"
                    placeholder="Select date"
                    type="date"
                    value-zone="Asia/Manila"
                    :week-start="7">
                </datetime>
            </b-field>
            <b-field label="Email">
                <b-input v-model="user.email" placeholder="ex. sample@email.com" type="email"></b-input>
            </b-field>
            <b-field label="Phone">
                <b-input v-model="user.phone" placeholder="ex. 09112345678"></b-input>
            </b-field>
            <b-field label="Password">
                <b-input v-model="user.password" password-reveal type="password"></b-input>
            </b-field>
        </div>
        <div class="container">
            <b-button @click="submit" :loading="isSubmitLoading" type="is-info">Register</b-button>
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
            return this.user.birthdate ? this.user.birthdate.toDateString() : '';
        }
    },
    methods: {
        submit() {
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
                window.location = '/' + this.userType;
            }).catch(error => {
                this.isSubmitLoading = false;
                this.$root.defaultError();
            });
        }
    }
}
</script>
