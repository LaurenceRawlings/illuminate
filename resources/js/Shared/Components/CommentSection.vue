<template>
    <div class="px-2 pt-4">
        <h2 class="text-2xl my-4 font-black">{{ comments ? comments.length : 0}} Comments</h2>

        <div v-if="$page.user" class="flex">
            <profile-photo :user="$page.user" class="w-10 h-10 mr-2" />
            <jet-input v-model="form.comment" class="mr-2 w-full" placeholder="Leave a comment..." />
            <jet-button @click.native.prevent="addComment">Comment</jet-button>
        </div>

        <jet-input-error :message="form.error('comment')" class="mt-2 ml-10" />

        <hr class="my-8"/>

        <comment v-for="comment in comments" :comment="comment" :key="comment.id" />
    </div>
</template>

<script>
import Comment from "@/Shared/Components/Comment";
import ProfilePhoto from "@/Shared/Components/ProfilePhoto";
import JetInput from "@/Jetstream/Input";
import JetButton from "@/Jetstream/Button";
import JetInputError from "@/Jetstream/InputError";

export default {
    components: {
        JetInputError,
        JetInput,
        ProfilePhoto,
        Comment,
        JetButton,
    },
    props: {
        postId: Number,
        comments: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                '_method': 'POST',
                comment: null,
                postId: this.postId
            }, {
                bag: 'addComment',
                resetOnSuccess: true,
            })
        }
    },
    methods: {
        addComment() {
            this.form.post(route('comments.store'), {
                preserveScroll: true
            });
        }
    }
}
</script>

<style scoped>

</style>
