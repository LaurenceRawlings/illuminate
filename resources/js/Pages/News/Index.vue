<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Latest Technology News
            </h2>
        </template>

        <div class="my-12 max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <a v-for="newsPost in newsPosts.data" :key="newsPost.id" :href="newsPost.url" target="_blank" rel="noopener noreferrer">
                    <news-post-card :news-post="newsPost" />
                </a>
            </div>

            <pagination-links
                :urls_array="paginated_links"
                :previous_page_url="newsPosts.prev_page_url"
                :next_page_url="newsPosts.next_page_url">
            </pagination-links>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Shared/Layouts/AppLayout'
    import NewsPostCard from "@/Pages/News/NewsPostCard";
    import PaginationLinks from "@/Shared/Components/PaginationLinks";

    export default {
        components: {
            AppLayout,
            NewsPostCard,
            PaginationLinks
        },
        props: {
            newsPosts: Object,
            paginated_links: Array,
        },
    }
</script>

<style scoped>

</style>
