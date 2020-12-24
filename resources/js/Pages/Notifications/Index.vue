<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Notifications
            </h2>
        </template>

        <div class="pb-2">
            <div class="my-12 max-w-7xl mx-auto px-4">

            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Shared/Layouts/AppLayout'
import PaginationLinks from "@/Shared/Components/PaginationLinks";

export default {
    components: {
        AppLayout,
        PaginationLinks,
    },
    props: {
        notifications: Object,
        paginated_links: Array,
    },
}
</script>

<style scoped>

</style>
