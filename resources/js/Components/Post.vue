<template>
    <div>
        <div class="overflow-hidden shadow rounded h-full">
            <div class="bg-cover bg-center h-56 p-4" style="background-image: url(https://wallpaperaccess.com/full/161199.jpg)">
                <div class="flex justify-end">
                    <svg class="h-6 w-6 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12.76 3.76a6 6 0 0 1 8.48 8.48l-8.53 8.54a1 1 0 0 1-1.42 0l-8.53-8.54a6 6 0 0 1 8.48-8.48l.76.75.76-.75zm7.07 7.07a4 4 0 1 0-5.66-5.66l-1.46 1.47a1 1 0 0 1-1.42 0L9.83 5.17a4 4 0 1 0-5.66 5.66L12 18.66l7.83-7.83z"></path>
                    </svg>
                </div>
            </div>
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
    props: ['post']
}
</script>

<style scoped>
    .mt--10 {
        margin-top: -10px;
    }
</style>
