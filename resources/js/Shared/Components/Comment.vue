<template>
    <div class="flex mb-4">
        <profile-photo :user="comment.user" class="w-10 h-10 mr-2"/>
        <div class="w-full">
            <span>
                <profile-link :user="comment.user" class="mr-2"/>
                <span class="text-gray-500">{{ comment.timestamp }}</span>
                <span class="text-gray-500 italic" v-show="comment.edited">(edited)</span>
                <span v-if="comment.can_edit || comment.can_delete">
                    <span> • </span>
                    <span @click="editClicked" class="hover:underline cursor-pointer"
                          :class="edit ? 'text-red-500 hover:text-red-800' : 'text-gray-500 hover:text-black'">{{
                            edit ? 'Cancel' : 'Edit'
                        }}</span>
                </span>
            </span>

            <div v-if="edit" class="flex">
                <div class="flex items-center mr-2 relative w-full">
                    <jet-input v-model="form.comment" class="w-full" maxlength="255" :disabled="!comment.can_edit"
                               @keyup.enter.native="updateComment"/>
                    <div class="right-0 absolute bg-gray-200 mr-2 px-2 rounded-full font-thin">
                        {{ form.comment ? form.comment.length : 0 }} / 255
                    </div>
                </div>
                <jet-button v-if="comment.can_edit" @click.native.prevent="updateComment">Update</jet-button>
                <jet-danger-button v-if="comment.can_delete" class="ml-2" @click.native="confirmCommentDeletion">
                    Delete
                </jet-danger-button>
                <jet-dialog-modal :show="confirmingCommentDeletion" @close="confirmingCommentDeletion = false">
                    <template #title>
                        Delete Comment
                    </template>

                    <template #content>
                        Are you sure you want to delete your comment? Once your comment is deleted, it will be
                        permanently deleted.
                    </template>

                    <template #footer>
                        <jet-secondary-button @click.native="confirmingCommentDeletion = false">
                            Nevermind
                        </jet-secondary-button>

                        <jet-danger-button class="ml-2" @click.native="deleteComment"
                                           :class="{ 'opacity-25': deleteForm.processing }"
                                           :disabled="deleteForm.processing">
                            Delete Comment
                        </jet-danger-button>
                    </template>
                </jet-dialog-modal>
            </div>

            <p v-else class="break-all">{{ comment.comment }}</p>

            <div class="flex items-center">
                <zap :zapped="comment.is_liked" :zappable-id="comment.id" zappable-type="comment" class="w-4 h-4 mr-1"/>
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
import JetDangerButton from "@/Jetstream/DangerButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetDialogModal from "@/Jetstream/DialogModal";

export default {
    components: {
        JetDangerButton,
        Zap,
        ProfileLink,
        ProfilePhoto,
        JetInput,
        JetButton,
        JetInputError,
        JetSecondaryButton,
        JetDialogModal,
    },
    props: {
        comment: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                '_method': 'PUT',
                comment: this.comment.comment,
                commentId: this.comment.id,
            }, {
                bag: 'updateComment',
                resetOnSuccess: true,
            }),
            edit: false,

            confirmingCommentDeletion: false,

            deleteForm: this.$inertia.form({
                '_method': 'DELETE',
            }, {
                bag: 'deleteComment'
            }),
        }
    },
    methods: {
        updateComment() {
            this.form.put(route('comments.update', this.comment.id), {
                preserveScroll: true
            }).then(() => {
                this.edit = false;
            });
        },
        editClicked() {
            this.edit = !this.edit
            if (this.edit) {
                this.form.comment = this.comment.comment
            }
        },
        confirmCommentDeletion() {
            this.confirmingCommentDeletion = true;
        },
        deleteComment() {
            this.deleteForm.post(route('comments.destroy', this.comment.id), {
                preserveScroll: true
            })
        },
    }
}
</script>

<style scoped>

</style>
