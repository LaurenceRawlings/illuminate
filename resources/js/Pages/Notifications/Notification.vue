<template>
    <inertia-link :href="notification.link">
        <div class="bg-white overflow-hidden shadow rounded-lg h-full w-full p-8 flex items-center mb-4">
            <profile-photo class="w-10 h-10 mr-2" :user="notification.user" />
            <span v-for="section in message">
            <profile-link :user="notification.user" class="px-1" v-if="section" />
            <span>{{ section }}</span>
        </span>
        </div>
    </inertia-link>
</template>

<script>
import ProfilePhoto from "@/Shared/Components/ProfilePhoto";
import ProfileLink from "@/Shared/Components/ProfileLink";
export default {
    components: {ProfileLink, ProfilePhoto},
    props: {
        notification: Object,
    },

    computed: {
        message() {
            return this.notification.message.split('{{USER}}');
        }
    }
}
</script>

<style scoped>

</style>
