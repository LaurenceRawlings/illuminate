<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Latest Posts
            </h2>
        </template>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-w-7xl mx-auto px-4">
            <post v-for="post in posts" :key="post.id" :title="post.title" :author="post.user_id" :description="post.description" :time="post.created_at" :thumbnailurl="post.thumbnail" url="" />
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Post from "@/Components/Post";

    export default {
        components: {
            AppLayout,
            Post,
        },
        props: {
            posts: Array,
        },
    }
</script>

<style scoped>

</style>
