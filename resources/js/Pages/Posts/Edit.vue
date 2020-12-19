<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form autocomplete="off">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="bg-cover bg-center h-96 p-4" :style="backgroundImage(thumbnailPreview ? thumbnailPreview : 'img/placeholder.png')">
                            <input type="file" class="hidden"
                                   ref="thumbnail"
                                   @change="updateThumbnail">

                            <jet-secondary-button type="button" @click.native.prevent="selectNewThumbnail">
                                Change Thumbnail
                            </jet-secondary-button>

                            <jet-secondary-button type="button" class="ml-2" @click.native.prevent="removeThumbnail">
                                Remove Thumbnail
                            </jet-secondary-button>
                        </div>

                        <div class="flex items-center px-24 bg-gray-200 bg-opacity-25">
                            <div class="mr-2">
                                <img :src="$page.user.profile_photo_url" alt="Current Profile Photo" class="rounded-full h-10 w-10 object-cover">
                            </div>

                            <div class="py-6">
                                {{ $page.user.name }}
                            </div>

                            <jet-button class="ml-auto" @click.native.prevent="createPost">
                                Publish
                            </jet-button>
                        </div>


                        <div class="px-24 pt-6 pb-24">
                            <jet-input id="title" type="text" class="text-4xl mb-2 font-bold block w-full" v-model="form.title" placeholder="Title" />
                            <jet-input id="description" type="text" class="text-2xl mb-2 font-semibold block w-full" v-model="form.description" placeholder="Description" />
                            <trumbowyg v-model="form.body" :config="config" class="form-control" name="content"></trumbowyg>
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
    },
    data () {
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
                resetOnSuccess: false,
            })
        }
    },

    methods: {
        ...methods,
        createPost() {
            if (this.thumbnailPreview) {
                this.form.thumbnail = this.$refs.thumbnail.files[0]
            }

            this.form.post(route('posts.store'), {
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
            this.thumbnailPreview = 'img/placeholder.png'
        },
    },
}
</script>

<style scoped>

</style>
