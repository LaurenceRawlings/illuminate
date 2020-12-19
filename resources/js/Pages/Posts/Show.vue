<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-cover bg-center h-96 p-4">
                        <img class="object-cover w-full h-full" :src="post.thumbnail_url" alt="Post Thumbnail" />
                    </div>

                    <div class="px-24 bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
                        <div class="py-6">
                            {{ post.user_name }}
                        </div>
                    </div>

                    <div class="px-24 pb-24 pt-6">
                        <h2 class="text-4xl font-bold">{{ post.title }}</h2>

                        <h3 class="text-2xl font-semibold mb-4">{{ post.description }}</h3>

                        <div v-html="post.body"></div>
                    </div>
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import computed from "@/Shared/computed";

export default {
    components: {
        AppLayout,
    },
    props: {
        post: Object,
    },
    computed: {...computed},
}
</script>

<style scoped>

</style>
