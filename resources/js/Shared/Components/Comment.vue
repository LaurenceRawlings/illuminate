<template>
    <div class="flex mb-4">
        <profile-photo :user="comment.user" class="w-10 h-10 mr-2" />
        <div class="w-full">
            <span>
                <profile-link :user="comment.user" class="mr-2" />
                <span class="text-gray-500">{{ comment.timestamp }}</span>
                <span class="text-gray-500 italic" v-show="comment.edited">(edited)</span>
                <span v-if="$page.user && $page.user.id === comment.user_id">
                    <span> • </span>
                    <span @click="editClicked" class="hover:underline cursor-pointer" :class="edit ? 'text-red-500 hover:text-red-800' : 'text-gray-500 hover:text-black'">{{ edit ? 'Cancel' : 'Edit' }}</span>
                </span>
            </span>

            <div v-if="edit" class="flex">
                <jet-input v-model="form.comment" class="mr-2 w-full" />
                <jet-button @click.native.prevent="updateComment">Update</jet-button>
            </div>

            <p v-else class="break-all">{{comment.comment}}</p>

            <div class="flex items-center">
                <zap :zapped="comment.is_liked" :zappable-id="comment.id" zappable-type="comment" class="w-4 h-4 mr-1" />
                <span>{{ comment.likes }}</span>
            </div>
        </div>
    </div>
</template>

<script>
import ProfilePhoto from "@/Shared/Components/ProfilePhoto";
import ProfileLink from "@/Shared/Components/ProfileLink";
import Zap from "@/Shared/Components/Zap";
import JetInput from "@/Jetstream/Input";
import JetButton from "@/Jetstream/Button";
import JetInputError from "@/Jetstream/InputError";

export default {
    components: {
        Zap,
        ProfileLink,
        ProfilePhoto,
        JetInput,
        JetButton
    },
    props: {
        comment: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                '_method': 'POST',
                comment: this.comment.comment,
                commentId: this.comment.id,
                postId: this.comment.post_id
            }, {
                bag: 'updateComment',
                resetOnSuccess: true,
            }),
            edit: false,
        }
    },
    methods: {
        updateComment() {
            this.form.post(route('comment.store'), {
                preserveScroll: true
            });

            this.edit = false;
        },
        editClicked() {
            this.edit = !this.edit
            if (this.edit) {
                this.form.comment = this.comment.comment
            }
        }
    }
}
</script>

<style scoped>

</style>
