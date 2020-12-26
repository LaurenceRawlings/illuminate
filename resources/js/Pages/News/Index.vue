<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Latest Technology News
            </h2>
        </template>

        <div class="pb-2">
            <div class="my-12 max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a v-for="newsPost in newsPosts.data" :key="newsPost.id" :href="newsPost.url"
                       rel="noopener noreferrer"
                       target="_blank">
                        <news-post-card :news-post="newsPost"/>
                    </a>
                </div>

                <pagination-links
                    :next_page_url="newsPosts.next_page_url"
                    :previous_page_url="newsPosts.prev_page_url"
                    :urls_array="paginated_links">
                </pagination-links>
            </div>
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
