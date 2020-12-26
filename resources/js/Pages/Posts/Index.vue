<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Latest Posts
            </h2>
        </template>

        <div class="pb-2">
            <div class="my-12 max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <inertia-link v-for="post in posts.data" :key="post.id" :href="route('read', {'p': post.id})">
                        <post-card :post="post"/>
                    </inertia-link>
                </div>

                <pagination-links
                    :next_page_url="posts.next_page_url"
                    :previous_page_url="posts.prev_page_url"
                    :urls_array="paginated_links">
                </pagination-links>
            </div>
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
