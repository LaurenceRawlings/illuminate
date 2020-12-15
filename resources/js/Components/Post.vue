<template>
    <div>
        <div class="overflow-hidden shadow rounded h-full">
            <div class="bg-cover bg-center h-56 p-4" :style="thumbnail"></div>
            <div class="bg-white p-4 rounded-t-lg mt--10">
                <div class="flex items-center">
                    <div class="bg-cover bg-center w-8 h-8 rounded-full mr-3 border-solid border-2 border-black" :style="icon"></div>
                    <p class="uppercase tracking-wide text-sm font-bold text-gray-700">{{ author }} • {{ time }}</p>
                </div>
                <p class="text-3xl text-gray-900">{{ title }}</p>
                <p class="text-gray-700">{{ description }}</p>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['title', 'description', 'author', 'time', 'url', 'thumbnailurl'],
    computed: {
        thumbnail() {
            return {
                'background-image': 'url(' + this.thumbnailurl + ')',
            }
        },
        icon() {
            return {
                'background-image': 'url(https://www.pngitem.com/pimgs/m/41-415019_profile-man-male-free-picture-male-avatar-clipart.png)',
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
