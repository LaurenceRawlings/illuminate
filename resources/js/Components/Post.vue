<template>
    <div>
        <div class="overflow-hidden shadow rounded h-full">
            <div class="bg-cover bg-center h-56 p-4" style="background-image: url(https://wallpaperaccess.com/full/161199.jpg)"></div>
            <div class="bg-white p-4 rounded-t-lg mt--10">
                <div class="flex items-center">
                    <div class="bg-cover bg-center w-8 h-8 rounded-full mr-3 border-solid border-2 border-black" style="background-image: url(https://www.pngitem.com/pimgs/m/41-415019_profile-man-male-free-picture-male-avatar-clipart.png)"></div>
                    <p class="uppercase tracking-wide text-sm font-bold text-gray-700">Post Author • 4h ago</p>
                </div>
                <p class="text-3xl text-gray-900">This is the post title!</p>
                <p class="text-gray-700">This is the posts description to summarise the post.</p>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['title', 'description', 'author', 'time', 'url', 'thumbnail-url']
}
</script>

<style scoped>
    .mt--10 {
        margin-top: -10px;
    }
</style>
