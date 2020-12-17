<template>
    <div class="overflow-hidden shadow rounded h-full">
        <div class="bg-cover bg-center h-56 p-4" :style="thumbnail"></div>
        <div class="bg-white p-4 rounded-t-lg mt--10 h-full">
            <div class="flex items-center">
                <div class="bg-cover bg-center w-8 h-8 rounded-full mr-3" :style="icon"></div>
                <p class="uppercase tracking-wide text-sm font-bold text-gray-700">{{ author }} • {{ time }}</p>
            </div>
            <p class="text-2xl text-gray-900">{{ title }}</p>
            <p class="text-gray-700">{{ description }}</p>
        </div>
    </div>
</template>

<script>

export default {
    props: ['title', 'description', 'author', 'time', 'thumbnailurl', 'authorpictureurl'],
    computed: {
        thumbnail() {
            return {
                'background-image': 'url(' + this.thumbnailurl + ')',
            }
        },
        icon() {
            return {
                'background-image': 'url(' + this.authorpictureurl + ')',
            }
        }
    }
}
</script>

<style scoped>
    .mt--10 {
        margin-top: -10px;
    }
</style>
