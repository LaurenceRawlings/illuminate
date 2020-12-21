<template>
    <inertia-link :href="route('user.show', user.username)" class="text-sm font-bold text-gray-700 hover:underline">
        {{ user.name }}
    </inertia-link>
</template>

<script>
export default {
    props: {
        user: Object,
    }
}
</script>

<style scoped>

</style>
