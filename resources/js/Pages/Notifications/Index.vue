<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Notifications
            </h2>
        </template>

        <div class="pb-2">
            <div class="my-12 max-w-7xl mx-auto px-4">
                <notification v-for="notification in notifications.data" :notification="notification.data" />

                <pagination-links
                    :next_page_url="notifications.next_page_url"
                    :previous_page_url="notifications.prev_page_url"
                    :urls_array="paginated_links">
                </pagination-links>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Shared/Layouts/AppLayout'
import PaginationLinks from "@/Shared/Components/PaginationLinks";
import Notification from "@/Pages/Notifications/Notification";

export default {
    components: {
        Notification,
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
