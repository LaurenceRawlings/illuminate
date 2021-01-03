<template>
    <div class="flex items-center">
        <inertia-link :href="route('user.show', user.username)" class="text-sm font-bold text-gray-700 hover:underline">
            {{ $page.user && $page.user.id === user.id ? 'You' : user.name }}
        </inertia-link>
        <admin-badge v-show="user.is_admin" class="ml-2 text-xs"/>
    </div>
</template>

<script>
import AdminBadge from "@/Shared/Components/AdminBadge";

export default {
    components: {AdminBadge},
    props: {
        user: Object,
    }
}
</script>

<style scoped>

</style>
