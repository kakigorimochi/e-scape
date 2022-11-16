<template>
    <div>Hello {{ userType }}!</div>
</template>

<script>
export default {
    data () {
        return {}
    },
    props: {
        userType: String,
    }
}
</script>
