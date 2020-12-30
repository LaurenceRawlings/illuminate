<template>
    <div class="z-10 fixed top-15 left-1/2
    origin-center text-lg text-white bg-blue-500 px-4 py-1 rounded-md font-bold shadow-2xl bg-opacity-75 transition-opacity duration-1000 ease-in-out"
    :class="show ? 'opacity-100' : 'opacity-0'"
    style="transform: translate(-50%, 0)">
        {{ $page.flash.message }}
    </div>
</template>

<script>
export default {
    data() {
        return {
            show: true
        }
    },
    mounted() {
        setTimeout(() => {
            this.show = false;
            setTimeout(() => {
                this.$page.flash.message = null;
            }, 1000)
        }, 5000)
    },
}
</script>

<style scoped>

</style>
