<template>
    <div class="container pt-6 px-6">
        <span class="is-size-1">Welcome operator!</span>
        <div class="container is-flex is-flex-direction-column mt-6 pb-6">
            <div class="mb-3">
                <b-button @click="dispatches" type="is-success is-light">Dispatches</b-button>
            </div>
            <div>
                <b-button @click="logout" type="is-info is-light">Logout</b-button>
            </div>
        </div>
        <b-modal v-model="isPassCodeVisible" :can-cancel="false" full-screen :width="480">
            <div class="container p-6">
                <div class="container">
                    <b-field label="Passcode">
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
                <div class="container is-flex is-justify-content-end p-3">
                    <b-button class="mr-3" @click="logout" type="is-light">Cancel</b-button>
                    <b-button @click="checkPasscode" type="is-success">Enter</b-button>
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
                this.$root.prompt('Invalid passcode! Please try again.');
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
