<template>
    <div class="container pt-6 px-6">
        <span class="is-size-1">Welcome commuter!</span>
        <div class="container is-flex is-flex-direction-column mt-6 pb-6">
            <div>
                <b-button @click="logout" type="is-info is-light">Logout</b-button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {};
    },
    methods: {
        logout() {
            axios.get('/logout').then(() => {
                window.location = '/';
            });
        }
    }
}
</script>
