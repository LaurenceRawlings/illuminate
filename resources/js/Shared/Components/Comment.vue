<template>
    <div class="flex mb-4">
        <profile-photo :user="comment.user" class="w-10 h-10 mr-2" />
        <div>
            <span>
                <profile-link :user="comment.user" class="mr-2" />
                <span class="text-gray-500">{{ comment.timestamp }}</span>
            </span>
            <p class="break-all">{{comment.comment}}</p>

            <div class="flex items-center">
                <zap class="w-4 h-4 mr-1" />
                25
            </div>
        </div>
    </div>
</template>

<script>
import ProfilePhoto from "@/Shared/Components/ProfilePhoto";
import ProfileLink from "@/Shared/Components/ProfileLink";
import Zap from "@/Shared/Components/Zap";

export default {
    components: {
        Zap,
        ProfileLink,
        ProfilePhoto
    },
    props: {
        comment: Object,
    }
}
</script>

<style scoped>

</style>
