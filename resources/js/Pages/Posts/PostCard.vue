<template>
    <div class="overflow-hidden shadow rounded h-full">
        <div class="bg-cover bg-center h-56 p-4" :style="backgroundImage(post.thumbnail_url)"></div>
        <div class="bg-white p-4 rounded-t-lg mt--10 h-full">
            <div class="flex items-center">
                <profile-photo :user="post.user" class="w-10 h-10 mr-2" />

                <div>
                    <profile-link :user="post.user" />
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

export default {
    components: {
        ProfilePhoto,
        ProfileLink,
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
    .mt--10 {
        margin-top: -10px;
    }
</style>
