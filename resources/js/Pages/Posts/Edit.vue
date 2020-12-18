<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <trumbowyg v-model="content" :config="config" class="form-control" name="content"></trumbowyg>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Trumbowyg from 'vue-trumbowyg';
import 'trumbowyg/dist/ui/trumbowyg.css';

export default {
    components: {
        AppLayout,
        Trumbowyg,
    },
    data () {
        return {
            content: null,
            config: {

            }
        }
    },
}
</script>

<style scoped>

</style>
