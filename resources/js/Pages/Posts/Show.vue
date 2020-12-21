<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div :style="backgroundImage(post.thumbnail_url)" class="bg-cover bg-center h-96 p-4"></div>

                    <div class="post-container">
                        <div class="flex items-center px-24 py-4 bg-gray-200 bg-opacity-25">
                            <profile-photo :user="post.user" class="w-10 h-10 mr-3" />

                            <profile-link :user="post.user" />

                            <div class="flex ml-auto items-center font-bold text-lg">
                                <zap :zapped="false" class="w-6 h-6 mr-1" />
                                10K
                            </div>
                        </div>

                        <div class="pt-6">
                            <h2 class="text-4xl font-bold">{{ post.title }}</h2>

                            <h3 class="text-2xl font-semibold mb-4">{{ post.description }}</h3>

                            <div class="trumbowyg-editor trumbowyg-reset-css body" v-html="post.body"></div>
                        </div>
                    </div>
                </div>

                <comment-section :comments="post.comments" />
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Shared/Layouts/AppLayout'
import methods from "@/Shared/methods";
import CommentSection from "@/Shared/Components/CommentSection";
import ProfileLink from "@/Shared/Components/ProfileLink";
import ProfilePhoto from "@/Shared/Components/ProfilePhoto";
import Zap from "@/Shared/Components/Zap";

import 'trumbowyg/dist/ui/trumbowyg.css';
import 'trumbowyg/dist/plugins/table/ui/trumbowyg.table.min.css';
import 'trumbowyg/dist/plugins/colors/ui/trumbowyg.colors.min.css';
import 'trumbowyg/dist/plugins/emoji/ui/trumbowyg.emoji.min.css';

export default {
    components: {
        ProfileLink,
        AppLayout,
        CommentSection,
        ProfilePhoto,
        Zap,
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
