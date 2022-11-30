<template>
    <div class="container pt-6 px-6">
        <div class="is-flex is-justify-content-center">
            <div class="is-flex is-flex-direction-column">
                <figure class="image mt-3 mx-auto is-64x64">
                    <img src="/img/e-logo.png">
                </figure>
                <span id="title" class="is-size-3">E-scape</span>
                <span class="has-text-centered is-size-6">Good day, {{ info.fname + ' ' + info.lname }}</span>
            </div>
        </div>
        <div class="container is-flex is-flex-direction-column mt-3 pb-3">
            <div class="mt-5">
                <b-button id="dispatch" class="is-medium is-fullwidth"
                @click="dispatches" type="is-success">Dispatch</b-button>
            </div>
            <div class="mt-5">
                <b-button id="logout" class="is-medium is-fullwidth"
                @click="logout" type="is-success is-light">Logout</b-button>
            </div>
        </div>
        <b-modal v-model="isPassCodeVisible" :can-cancel="false" full-screen :width="480">
            <div id="pincode" class="container pt-6 px-6">
                <div id="header" class="is-flex is-justify-content-left">
                    <figure class="image mt-3 mb-4 is-48x48">
                        <img src="/img/e-logo.png">
                    </figure>
                    <span id="title" class="is-size-4">E-scape</span>
                </div>
                <div class="container is-flex is-flex-direction-column mt-6 pb-3">
                    <b-field label="Operator Code" :message="'Never share your PIN or OTP with anyone.'">
                        <b-input v-model="pins[0]" @keyup.native="changeFocus('pinB')"
                            :min="0" :max="9" ref="pinA" type="number"></b-input>
                        <b-input v-model="pins[1]" @keyup.native="changeFocus('pinC')"
                            :min="0" :max="9" ref="pinB" type="number"></b-input>
                        <b-input v-model="pins[2]" @keyup.native="changeFocus('pinD')"
                            :min="0" :max="9" ref="pinC" type="number"></b-input>
                        <b-input v-model="pins[3]" @keyup.native="checkPasscode"
                            :min="0" :max="9" ref="pinD" type="number"></b-input>
                    </b-field>
                </div>
                <div class="mb-5">
                    <b-button id="continue" class="is-medium is-fullwidth"
                    @click="checkPasscode" type="is-success">Continue</b-button>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    data () {
        return {
            isPassCodeVisible: true,
            defaultPasscode: '1234',
            pins: []
        };
    },
    props: {
        info: Object,
    },
    methods: {
        changeFocus(ref) {
            this.$refs[ref].focus();
        },
        checkPasscode() {
            let pin = this.pins.join('');
            if (pin == this.defaultPasscode)
                this.isPassCodeVisible = false;
            else {
                this.pins = [];
                this.$refs.pinA.focus();
                this.$root.defaultError('Invalid passcode! Please try again.');
            }
        },
        dispatches() {
            window.location = '/operator/dispatches';
        },
        logout() {
            axios.get('/logout').then(() => {
                window.location = '/';
            });
        }
    }
}
</script>
