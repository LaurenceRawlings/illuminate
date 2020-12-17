<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Latest Posts
            </h2>
        </template>

        <div class="my-12 max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <post v-for="post in posts.data" :key="post.id" :title="post.title" :author="post.user_name" :description="post.description" :time="post.published" :thumbnailurl="post.thumbnail" :authorpictureurl="post.user_photo" />
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
import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
        AppLayout,
    },
    props: {
        post: Object,
    },
}
</script>

<style scoped>

</style>
