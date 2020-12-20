<template>
    <app-layout>
        <div class="my-12 max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <inertia-link v-for="post in posts.data" :key="post.id" :href="route('read', {'p': post.id})">
                    <post-card :post="post"/>
                </inertia-link>
            </div>

            <pagination-links
                :urls_array="paginated_links"
                :previous_page_url="posts.prev_page_url"
                :next_page_url="posts.next_page_url">
            </pagination-links>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Shared/Layouts/AppLayout'
import PostCard from "@/Pages/Posts/PostCard";
import PaginationLinks from "@/Shared/Components/PaginationLinks";

export default {
    components: {
        AppLayout,
        PostCard,
        PaginationLinks,
    },
    props: {
        posts: Object,
        paginated_links: Array,
    },
}
</script>

<style scoped>

</style>
