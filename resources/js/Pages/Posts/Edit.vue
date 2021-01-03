<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form autocomplete="off">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div
                            :style="backgroundImage(thumbnailPreview ? thumbnailPreview : defaultThumbnail)"
                            class="bg-cover bg-center h-96 p-4">
                            <input ref="thumbnail" accept=".jpg,.jpeg,.png,.gif"
                                   class="hidden"
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
                                <profile-photo :user="$page.user" class="w-10 h-10 mr-2"/>

                                <div class="py-6 text-sm font-bold text-gray-700">
                                    {{ $page.user.name }}
                                </div>

                                <jet-button class="ml-auto" @click.native.prevent="createPost">
                                    {{ this.post ? 'Update' : 'Publish' }}
                                </jet-button>
                            </div>


                            <div class="pt-6">
                                <jet-input-error v-if="form.hasErrors('createPost')" message="Publish failed!"/>
                                <jet-input-error :message="form.error('thumbnail')"/>
                                <jet-input-error :message="form.error('title')"/>
                                <jet-input-error :message="form.error('description')"/>
                                <jet-input-error :message="form.error('body')"/>

                                <div class="relative flex mb-4">
                                    <textarea id="title" v-model="form.title" class="text-4xl font-bold input"
                                              maxlength="150"
                                              placeholder="Title"
                                              rows="1" type="text"/>
                                    <div class="right-0 absolute bg-gray-200 mr-2 px-2 rounded-full font-thin">
                                        {{ form.title ? form.title.length : 0 }} / 150
                                    </div>
                                </div>

                                <div class="relative flex mb-8">
                                    <textarea id="description" v-model="form.description"
                                              class="text-2xl font-semibold input"
                                              maxlength="255" placeholder="Description"
                                              rows="1" type="text"/>

                                    <div class="right-0 absolute bg-gray-200 mr-2 px-2 rounded-full font-thin">
                                        {{ form.description ? form.description.length : 0 }} / 255
                                    </div>
                                </div>

                                <trumbowyg v-model="form.body" :config="config" class="form-control"
                                           name="content"
                                           placeholder="Write your post here..."></trumbowyg>

                                <div class="mt-4 text-right">
                                    <diV class="text-md font-bold text-gray-700">{{ form.body ? form.body.length : 0 }}
                                        / 20000
                                    </diV>
                                    <div class="italic text-xs text-gray-400">(includes html tags)</div>
                                </div>
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
import ProfilePhoto from "@/Shared/Components/ProfilePhoto";
import BackgroundImage from "@/Mixins/BackgroundImage";

import Trumbowyg from 'vue-trumbowyg';
import 'trumbowyg/dist/ui/trumbowyg.css';
import 'trumbowyg/dist/plugins/table/ui/trumbowyg.table.min.css';
import 'trumbowyg/dist/plugins/colors/ui/trumbowyg.colors.min.css';
import 'trumbowyg/dist/plugins/emoji/ui/trumbowyg.emoji.min.css';

import 'trumbowyg/dist/plugins/giphy/ui/trumbowyg.giphy.min.css';
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
import 'trumbowyg/dist/plugins/giphy/trumbowyg.giphy.min.js';

export default {
    mixins: [BackgroundImage],
    components: {
        ProfilePhoto,
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
                        dropdown: ['upload', 'insertImage', 'giphy'],
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
                    },
                    giphy: {
                        apiKey: '9TLYRTqXGpDQdz81QYNQBACcoYhL1tSg'
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
                remove_thumbnail: false,
            }, {
                bag: 'createPost',
                resetOnSuccess: true,
            })
        }
    },

    methods: {
        createPost() {
            if (this.post) {
                this.form._method = 'PUT';
                this.form.post(route('posts.update', this.post.id), {
                    preserveScroll: true
                });
            } else {
                this.form.post(route('posts.store'), {
                    preserveScroll: true
                });
            }
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
            this.form.thumbnail = this.$refs.thumbnail.files[0]
            this.form.remove_thumbnail = false;
        },

        removeThumbnail() {
            this.thumbnailPreview = null;
            this.form.remove_thumbnail = true;
        },
    },

    props: {
        post: Object,
        defaultThumbnail: String,
    },

    mounted() {
        if (this.post) {
            this.thumbnailPreview = this.post.thumbnail_url
            this.form.title = this.post.title
            this.form.description = this.post.description
            this.form.body = this.post.body
        }
        $('textarea').autoResize();
    }
}
</script>

<style scoped>
.input {
    @apply w-full;
    @apply border-b-2;
    @apply border-solid;
    @apply resize-none;
    @apply h-auto;
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
