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
                        <post-card>
                            <template #thumbnail>
                                <img :src="newsPost.thumbnail"
                                     alt="Thumbnail" class="h-full w-full object-cover inset-0">
                            </template>
                            <template #icon>
                                <a :href="host(newsPost.url)" rel="noopener noreferrer" target="_blank">
                                    <div class="w-10 h-10">
                                        <img :src="newsPost.favicon"
                                             :alt="newsPost.source" class="rounded-full h-full w-full object-cover">
                                    </div>
                                </a>
                            </template>
                            <template #user>
                                <a :href="host(newsPost.url)" class="text-sm font-bold text-gray-700 hover:underline"
                                   rel="noopener noreferrer"
                                   target="_blank">{{ newsPost.source }}</a>
                            </template>
                            <template #details>{{ newsPost.timestamp }}</template>
                            <template #title>{{ newsPost.title }}</template>
                            <template #description>{{ newsPost.description }}</template>
                        </post-card>
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
import PaginationLinks from "@/Shared/Components/PaginationLinks";
import PostCard from "@/Shared/Components/PostCard";

export default {
    components: {
        AppLayout,
        PaginationLinks,
        PostCard
    },
    props: {
        newsPosts: Object,
        paginated_links: Array,
    },
    methods: {
        host(postUrl) {
            let url = new URL(postUrl);
            return `${url.protocol}${url.hostname}`
        }
    }
}
</script>

<style scoped>

</style>
