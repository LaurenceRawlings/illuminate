<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-cover bg-center h-96 p-4" :style=""></div>

                    <div class="px-24 bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
                        <div class="py-6">
                            {{ $page.user.name }}
                        </div>
                    </div>

                    <trumbowyg v-model="content" :config="config" class="form-control" name="content"></trumbowyg>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import computed from "@/Shared/computed";

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
    },
    data () {
        return {
            content: null,
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
            }
        }
    },
    computed: {...computed},
}
</script>

<style scoped>

</style>
