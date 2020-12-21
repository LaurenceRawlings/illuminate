<template>
    <div class="px-2 pt-4">
        <h2 class="text-2xl my-4 font-black">{{ comments ? comments.length : 0}} Comments</h2>

        <div v-if="$page.user" class="flex">
            <profile-photo :user="$page.user" class="w-10 h-10 mr-2" />
            <jet-input v-model="comment" class="mr-2 w-full" placeholder="Leave a comment..." />
            <jet-button @click.native.prevent="addComment($page.user)">Comment</jet-button>
        </div>

        <hr class="my-8"/>

        <comment v-for="comment in comments" :comment="comment" :key="comment.id" />
    </div>
</template>

<script>
import Comment from "@/Shared/Components/Comment";
import ProfilePhoto from "@/Shared/Components/ProfilePhoto";
import JetInput from "@/Jetstream/Input";
import JetButton from "@/Jetstream/Button";

export default {
    components: {
        JetInput,
        ProfilePhoto,
        Comment,
        JetButton,
    },
    props: {
        comments: Array,
    },
    data() {
        return {
            comment: null,
            list: this.comments,
        }
    },
    methods: {
        addComment(user) {
            this.list.unshift({
               user: user,
               comment: this.comment,
            });
        }
    }
}
</script>

<style scoped>

</style>
