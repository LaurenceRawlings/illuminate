<template>
    <div>
        <inertia-link :href="route('user.show', user.username)">
            <img :src="user ? user.profile_photo_url : undefined"
                 :alt="user ? user.username : 'User Photo'"
                 class="rounded-full h-full w-full object-cover border-2 border-solid border-gray-200">
        </inertia-link>
    </div>
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
