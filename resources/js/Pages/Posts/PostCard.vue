<template>
    <div class="overflow-hidden shadow rounded h-full">
        <div class="bg-cover bg-center h-56 p-4" :style="backgroundImage(post.thumbnail_url)"></div>
        <div class="bg-white p-4 rounded-t-lg mt--10 h-full">
            <div class="flex items-center">
                <div class="bg-cover bg-center w-10 h-10 rounded-full mr-3" :style="backgroundImage(post.user_photo)"></div>
                <div>
                    <p class="tracking-wide text-sm font-bold text-gray-700">{{ post.user_name }}</p>
                    <p class="text-sm text-gray-700">
                        {{ post.views }} views • {{ post.timestamp }}
                    </p>
                </div>
            </div>
            <p class="text-2xl text-gray-900">{{ post.title }}</p>
            <p class="text-gray-700">{{ post.description }}</p>
        </div>
    </div>
</template>

<script>
import methods from "@/Shared/methods";

export default {
    props: {
        post: Object,
    },
    methods: {
        ...methods,
    }
}
</script>

<style scoped>
    .mt--10 {
        margin-top: -10px;
    }
</style>
