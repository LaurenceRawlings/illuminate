<template>
    <div class="overflow-hidden shadow rounded h-full">
        <div :style="backgroundImage(newsPost.thumbnail_url)" class="bg-cover bg-center h-56 p-4"></div>
        <div class="bg-white p-4 rounded-t-lg mt--10 h-full">
            <div class="flex items-center">
                <a :href="host" class="text-sm font-bold text-gray-700 hover:underline" rel="noopener noreferrer"
                   target="_blank">
                    <div :style="backgroundImage(newsPost.favicon)"
                         class="bg-cover bg-center w-10 h-10 rounded-full mr-3"></div>
                </a>
                <div>
                    <a :href="host" class="text-sm font-bold text-gray-700 hover:underline" rel="noopener noreferrer"
                       target="_blank">{{ newsPost.source }}</a>
                    <p class="text-sm text-gray-700">{{ newsPost.timestamp }}</p>
                </div>
            </div>
            <p class="text-2xl text-gray-900">{{ newsPost.title }}</p>
            <p class="text-gray-700">{{ newsPost.description }}</p>
        </div>
    </div>
</template>

<script>
import methods from "@/Shared/methods";

export default {
    props: {
        newsPost: Object,
    },
    methods: {
        ...methods,
    },
    computed: {
        host() {
            let url = new URL(this.newsPost.url);
            return `${url.protocol}${url.hostname}`
        }
    }
}
</script>

<style scoped>
.mt--10 {
    margin-top: -10px;
}
</style>
