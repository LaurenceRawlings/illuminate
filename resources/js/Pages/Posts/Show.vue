<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-cover bg-center h-96 p-4" :style="backgroundImage(post.thumbnail_url)"></div>

                    <div class="flex items-center px-24 bg-gray-200 bg-opacity-25">
                        <div class="bg-cover bg-center w-10 h-10 rounded-full mr-3" :style="backgroundImage(post.user_photo)"></div>

                        <div class="py-6 font-bold">
                            {{ post.user_name }}
                        </div>
                    </div>

                    <div class="px-24 pb-24 pt-6">
                        <h2 class="text-4xl font-bold">{{ post.title }}</h2>

                        <h3 class="text-2xl font-semibold mb-4">{{ post.description }}</h3>

                        <div v-html="post.body" class="trumbowyg-editor trumbowyg-reset-css body"></div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Shared/Layouts/AppLayout'
import methods from "@/Shared/methods";

import 'trumbowyg/dist/ui/trumbowyg.css';
import 'trumbowyg/dist/plugins/table/ui/trumbowyg.table.min.css';
import 'trumbowyg/dist/plugins/colors/ui/trumbowyg.colors.min.css';
import 'trumbowyg/dist/plugins/emoji/ui/trumbowyg.emoji.min.css';

export default {
    components: {
        AppLayout,
    },
    props: {
        post: Object,
    },
    methods: {
        ...methods,
    },
}
</script>

<style scoped>
    .trumbowyg-editor {
        @apply p-0;
    }
</style>
