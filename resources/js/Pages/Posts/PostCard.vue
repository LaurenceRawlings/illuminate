<template>
    <div class="bg-white overflow-hidden shadow rounded-lg h-full">
        <div :style="post.thumbnail_url.split('.').pop() === 'gif' ? {} : backgroundImage(post.thumbnail_url)"
             class="h-56 w-full shadow-inner overflow-hidden">
            <vue-freezeframe v-if="post.thumbnail_url.split('.').pop() === 'gif'" :options="{ overlay: true }"
                             :src="post.thumbnail_url"></vue-freezeframe>
        </div>

        <div class="p-4 h-full">
            <div class="flex items-center">
                <profile-photo :user="post.user" class="w-10 h-10 mr-2"/>

                <div class="text-sm text-gray-700">
                    <profile-link :user="post.user"/>
                    <p>
                        <span>{{ post.views_formatted }} views</span>
                        <span> • {{ post.timestamp }}</span>
                        <span v-show="post.edited" class="italic">(edited)</span>
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
import ProfilePhoto from "@/Shared/Components/ProfilePhoto";
import ProfileLink from "@/Shared/Components/ProfileLink";
import {VueFreezeframe} from 'vue-freezeframe';

export default {
    components: {
        ProfilePhoto,
        ProfileLink,
        VueFreezeframe,
    },
    props: {
        post: Object,
    },
    methods: {
        ...methods,
    }
}
</script>

<style scoped>

</style>
