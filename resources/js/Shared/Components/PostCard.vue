<template>
    <div class="bg-white overflow-hidden shadow rounded-lg h-full">
        <div class="h-56 w-full">
            <slot name="thumbnail"></slot>
        </div>

        <div class="p-4 h-full">
            <div class="flex items-center">
                <div class="mr-4">
                    <slot name="icon"></slot>
                </div>

                <div class="text-sm">
                    <slot name="user"></slot>
                    <p class="text-gray-700">
                        <slot name="details"></slot>
                    </p>
                </div>
            </div>
            <p class="text-2xl text-gray-900">
                <slot name="title"></slot>
            </p>
            <p class="text-gray-700">
                <slot name="description"></slot>
            </p>
        </div>
    </div>
</template>

<script>
export default {}
</script>

<style scoped>

</style>
