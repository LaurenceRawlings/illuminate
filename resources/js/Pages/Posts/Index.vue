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
                    <inertia-link v-for="post in posts.data" :key="post.id" :href="route('posts.show', post.id)">
                        <post-card>
                            <template #thumbnail>
                                <img :src="post.thumbnail_url"
                                     alt="Thumbnail" class="h-full w-full object-cover object-center">
                            </template>
                            <template #icon>
                                <profile-photo :user="post.user" class="w-10 h-10"/>
                            </template>
                            <template #user>
                                <profile-link :user="post.user"/>
                            </template>
                            <template #details>
                                <span>{{ post.views_formatted }} views</span>
                                <span> • {{ post.timestamp }}</span>
                                <span v-show="post.edited" class="italic">(edited)</span>
                            </template>
                            <template #title>{{ post.title }}</template>
                            <template #description>{{ post.description }}</template>
                        </post-card>
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
import PaginationLinks from "@/Shared/Components/PaginationLinks";
import PostCard from "@/Shared/Components/PostCard";
import ProfilePhoto from "@/Shared/Components/ProfilePhoto";
import ProfileLink from "@/Shared/Components/ProfileLink";

export default {
    components: {
        ProfileLink,
        ProfilePhoto,
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
