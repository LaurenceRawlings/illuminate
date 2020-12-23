<template>
    <div class="bg-white overflow-hidden shadow rounded-lg h-full">
        <div class="h-56 w-full shadow-inner overflow-hidden" :style="post.thumbnail_url.split('.').pop() === 'gif' ? {} : backgroundImage(post.thumbnail_url)">
            <vue-freezeframe v-if="post.thumbnail_url.split('.').pop() === 'gif'" :src="post.thumbnail_url" :options="{ overlay: true }"></vue-freezeframe>
        </div>

        <div class="p-4 h-full">
            <div class="flex items-center">
                <profile-photo :user="post.user" class="w-10 h-10 mr-2"/>

                <div>
                    <profile-link :user="post.user"/>
                    <p class="text-sm text-gray-700">
                        {{ post.views_formatted }} views • {{ post.timestamp }}
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
