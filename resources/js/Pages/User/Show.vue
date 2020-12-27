<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User <span class="text-blue-500 font-black mx-2">/</span> {{ profile.user.username }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col lg:flex-row">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex-shrink p-8 h-full">
                    <div class="text-center w-72">
                        <profile-photo :user="profile.user" class="mb-4" />
                        <span class="text-2xl font-bold text-gray-700">{{ profile.user.name }}</span>

                        <div class="text-xl">
                            <span>{{ profile.status_emoji }}</span>
                            <span class="italic">{{ profile.status_text }}</span>
                        </div>

                        <div class="my-4">
                            {{ profile.bio }}
                        </div>
                        <inertia-link :href="route('profile.show')">
                            <jet-button v-show="$page.user.id === profile.user.id" class="w-full">
                                <span class="w-full">Edit Profile</span>
                            </jet-button>
                        </inertia-link>
                    </div>

                    <hr class="my-4">

                    <div class="mt-4">
                        <h2 class="text-2xl mb-2">Statistics</h2>
                        <div class="flex items-center mb-2">
                            <svg class="w-8 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>{{ profile.total_posts }} posts</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <svg class="w-8 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                            <span>{{ profile.total_views }} views</span>
                        </div>

                        <div class="flex items-center mb-2">
                            <svg class="w-8 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <span>{{ profile.total_likes }} zaps</span>
                        </div>
                    </div>
                </div>

                <div class="flex-grow pl-8">
                    <div>
                        <h1 class="text-2xl font-bold mb-2">All Posts</h1>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <inertia-link v-for="post in posts.data" :key="post.id" :href="route('read', {'p': post.id})">
                                <post-card class="max-w-sm">
                                    <template #thumbnail>
                                        <img :src="post.thumbnail_url"
                                             alt="Thumbnail" class="h-full w-full object-cover inset-0">
                                    </template>
                                    <template #icon>
                                        <profile-photo :user="post.user" class="w-10 h-10" />
                                    </template>
                                    <template #user>
                                        <profile-link :user="post.user" />
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
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Shared/Layouts/AppLayout'
import ProfilePhoto from "@/Shared/Components/ProfilePhoto";
import ProfileLink from "@/Shared/Components/ProfileLink";
import JetButton from "@/Jetstream/Button";
import PostCard from "@/Shared/Components/PostCard";
import PaginationLinks from "@/Shared/Components/PaginationLinks";

export default {
    components: {
        JetButton,
        ProfileLink,
        ProfilePhoto,
        AppLayout,
        PostCard,
        PaginationLinks,
    },
    props: {
        profile: Object,
        posts: Object,
        paginated_links: Array,
    },
}
</script>

<style scoped>

</style>
