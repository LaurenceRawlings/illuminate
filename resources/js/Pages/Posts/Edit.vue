<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form autocomplete="off">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div :style="backgroundImage(thumbnailPreview ? thumbnailPreview : 'storage/app-images/default-thumbnail.png')"
                             class="bg-cover bg-center h-96 p-4">
                            <input ref="thumbnail" class="hidden"
                                   type="file"
                                   @change="updateThumbnail">

                            <jet-secondary-button class="ml-2 mt-2" type="button"
                                                  @click.native.prevent="selectNewThumbnail">
                                Change Thumbnail
                            </jet-secondary-button>

                            <jet-secondary-button class="ml-2 mt-2" type="button"
                                                  @click.native.prevent="removeThumbnail">
                                Remove Thumbnail
                            </jet-secondary-button>
                        </div>

                        <div class="post-container">
                            <div class="flex items-center bg-gray-200 bg-opacity-25">
                                <div class="mr-2">
                                    <img :src="$page.user.profile_photo_url" alt="Current Profile Photo"
                                         class="rounded-full h-10 w-10 object-cover">
                                </div>

                                <div class="py-6">
                                    {{ $page.user.name }}
                                </div>

                                <jet-button class="ml-auto" @click.native.prevent="createPost">
                                    Publish
                                </jet-button>
                            </div>


                            <div class="pt-6">
                                <jet-input-error v-if="form.hasErrors('createPost')" message="Publish failed!"/>
                                <jet-input-error :message="form.error('thumbnail')"/>
                                <jet-input-error :message="form.error('title')"/>
                                <jet-input-error :message="form.error('description')"/>
                                <jet-input-error :message="form.error('body')"/>

                                <input id="title" v-model="form.title" class="text-4xl font-bold mb-4 input" placeholder="Title"
                                       type="text"/>

                                <input id="description" v-model="form.description" class="text-2xl font-semibold mb-8 input"
                                       placeholder="Description" type="text"/>

                                <trumbowyg v-model="form.body" :config="config" placeholder="Write your post here..." class="form-control"
                                           name="content"></trumbowyg>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Shared/Layouts/AppLayout';
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import methods from "@/Shared/methods";

import Trumbowyg from 'vue-trumbowyg';
import 'trumbowyg/dist/ui/trumbowyg.css';
import 'trumbowyg/dist/plugins/table/ui/trumbowyg.table.min.css';
import 'trumbowyg/dist/plugins/colors/ui/trumbowyg.colors.min.css';
import 'trumbowyg/dist/plugins/emoji/ui/trumbowyg.emoji.min.css';

import 'trumbowyg/dist/plugins/history/trumbowyg.history.min.js';
import 'jquery-resizable-dom/dist/jquery-resizable.min.js';
import 'trumbowyg/dist/plugins/resizimg/trumbowyg.resizimg.min.js';
import 'trumbowyg/dist/plugins/table/trumbowyg.table.min.js';
import 'trumbowyg/dist/plugins/colors/trumbowyg.colors.min.js';
import 'trumbowyg/dist/plugins/emoji/trumbowyg.emoji.min.js';
import 'trumbowyg/dist/plugins/pasteembed/trumbowyg.pasteembed.min.js';
import 'trumbowyg/dist/plugins/preformatted/trumbowyg.preformatted.min.js';
import 'trumbowyg/dist/plugins/indent/trumbowyg.indent.min.js';
import 'trumbowyg/dist/plugins/upload/trumbowyg.upload.min.js';

export default {
    components: {
        AppLayout,
        Trumbowyg,
        JetButton,
        JetSecondaryButton,
        JetInput,
        JetInputError,
    },
    data() {
        return {
            config: {
                resetCss: true,
                tagsToRemove: ['script', 'link'],
                autogrow: true,
                minimalLinks: true,
                defaultLinkTarget: '_blank',

                btns: [
                    ['historyUndo', 'historyRedo'],
                    ['formatting'],
                    ['strong', 'em', 'del'],
                    ['superscript', 'subscript'],
                    ['align', 'indent', 'outdent'],
                    ['foreColor', 'backColor'],
                    ['preformatted'],
                    ['unorderedList', 'orderedList'],
                    ['link'],
                    ['image', 'emoji'],
                    ['table', 'horizontalRule'],
                    ['removeformat'],
                    ['viewHTML', 'fullscreen']
                ],

                btnsDef: {
                    align: {
                        dropdown: ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                        ico: 'justifyLeft'
                    },
                    image: {
                        dropdown: ['upload', 'insertImage'],
                        ico: 'insertImage'
                    }
                },


                plugins: {
                    resizimg: {
                        minSize: 64,
                        step: 16,
                    },
                    upload: {
                        serverPath: 'https://api.imgur.com/3/image',
                        fileFieldName: 'image',
                        headers: {
                            'Authorization': 'Client-ID 1478f73e0068323'
                        },
                        urlPropertyName: 'data.link'
                    }
                },
            },
            thumbnailPreview: null,
            form: this.$inertia.form({
                '_method': 'POST',
                thumbnail: null,
                title: null,
                description: null,
                body: null,
            }, {
                bag: 'createPost',
                resetOnSuccess: true,
            })
        }
    },

    methods: {
        ...methods,
        createPost() {
            if (this.thumbnailPreview) {
                this.form.thumbnail = this.$refs.thumbnail.files[0]
            }

            this.form.post(route('post.store'), {
                preserveScroll: true
            });
        },

        selectNewThumbnail() {
            this.$refs.thumbnail.click();
        },

        updateThumbnail() {
            const reader = new FileReader();

            reader.onload = (e) => {
                this.thumbnailPreview = e.target.result;
            };

            reader.readAsDataURL(this.$refs.thumbnail.files[0]);
        },

        removeThumbnail() {
            this.thumbnailPreview = null;
        },
    },
}
</script>

<style scoped>
.input {
    @apply w-full;
    @apply block;
    @apply border-b-2;
    @apply border-solid;
}
</style>

<style>
.trumbowyg-box, .trumbowyg-editor {
    @apply border-t-0;
    @apply border-l-0;
    @apply border-r-0;
    @apply border-b-2;
}

.trumbowyg-editor, .trumbowyg-textarea {
    @apply p-0;
    @apply pt-4;
}

.trumbowyg-button-pane {
    @apply rounded;
}

.trumbowyg-button-pane::after {
    @apply bg-transparent;
}
</style>
