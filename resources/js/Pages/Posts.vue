<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Latest Posts
            </h2>
        </template>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-w-7xl mx-auto px-4">
            <post title="This is the post title!" author="Post Author" description="This is the posts description to summarise the post." time="4h ago" thumbnailurl="https://wallpaperaccess.com/full/161199.jpg" url="" />
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
    }
</script>

<style scoped>

</style>
