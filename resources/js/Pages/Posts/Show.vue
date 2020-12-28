<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="h-full overflow-hidden" :style="{ 'max-height': '40vh' }">
                        <img :src="post.thumbnail_url"
                             alt="Thumbnail" class="h-full w-full object-cover inset-0">
                    </div>

                    <div class="post-container">
                        <div class="flex items-center px-24 py-4 bg-gray-200 bg-opacity-25">
                            <profile-photo :user="post.user" class="w-10 h-10 mr-3"/>

                            <div class="text-sm text-gray-700">
                                <profile-link :user="post.user"/>
                                <p>
                                    <span>{{ post.views_formatted }} views</span>
                                    <span> • {{ post.timestamp }}</span>
                                    <span v-show="post.edited" class="italic">(edited)</span>
                                </p>
                            </div>

                            <div class="flex ml-auto items-center font-bold text-lg">
                                <zap :zappable-id="post.id" :zapped="post.is_liked" class="w-6 h-6 mr-1"
                                     zappable-type="post"/>
                                <span>{{ post.likes }}</span>
                                <inertia-link v-if="$page.user && $page.user.id === post.user_id" :href="route('posts.edit', post.id)"
                                              class="ml-4">
                                    <jet-button>
                                        Edit
                                    </jet-button>
                                </inertia-link>
                            </div>
                        </div>

                        <div class="pt-6">
                            <h2 class="text-4xl font-bold">{{ post.title }}</h2>

                            <h3 class="text-2xl font-semibold mb-4">{{ post.description }}</h3>

                            <div class="trumbowyg-editor trumbowyg-reset-css body" v-html="post.body"></div>
                        </div>
                    </div>
                </div>

                <comment-section :comments="comments" :post-id="post.id"/>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Shared/Layouts/AppLayout'
import CommentSection from "@/Shared/Components/CommentSection";
import ProfileLink from "@/Shared/Components/ProfileLink";
import ProfilePhoto from "@/Shared/Components/ProfilePhoto";
import Zap from "@/Shared/Components/Zap";
import JetButton from "@/Jetstream/Button";

import 'trumbowyg/dist/ui/trumbowyg.css';
import 'trumbowyg/dist/plugins/table/ui/trumbowyg.table.min.css';
import 'trumbowyg/dist/plugins/colors/ui/trumbowyg.colors.min.css';
import 'trumbowyg/dist/plugins/emoji/ui/trumbowyg.emoji.min.css';
import BackgroundImage from "@/Mixins/BackgroundImage";

export default {
    mixins: [BackgroundImage],
    components: {
        ProfileLink,
        AppLayout,
        CommentSection,
        ProfilePhoto,
        Zap,
        JetButton,
    },
    props: {
        post: Object,
        comments: Array,
    },
}
</script>

<style scoped>
.trumbowyg-editor {
    @apply p-0;
}
</style>
