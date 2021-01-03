<template>
    <button type="button" @click="like">
        <svg :class="zapped ? 'text-yellow-400': 'text-gray-400'" fill="none" viewBox="0 0 512 512"
             xmlns="http://www.w3.org/2000/svg">
            <path
                d="M213.333 512C201.365 512 192 502.635 192 490.667C192 490.283 192.021 488.853 192.064 488.469L212.139 298.667H106.667C94.6987 298.667 85.3334 289.301 85.3334 277.333C85.3334 272.789 86.8907 268.117 89.6214 264.512L259.925 9.024C264.256 3.2 270.656 0 277.333 0C289.301 0 298.667 9.36533 298.667 21.3333C298.667 21.76 298.645 23.4453 298.603 23.872L278.656 192H405.333C417.301 192 426.667 201.365 426.667 213.333C426.667 217.835 425.109 222.507 422.4 226.133L230.635 503.147C226.411 508.8 220.011 512 213.333 512Z"
                fill="currentColor"/>
        </svg>
    </button>
</template>

<script>
export default {
    props: {
        zapped: Boolean,
        zappableType: String,
        zappableId: Number,
    },
    data() {
        return {
            form: this.$inertia.form({
                '_method': 'POST',
                likeableId: this.zappableId,
            }, {
                bag: 'like',
                resetOnSuccess: true,
            }),
        }
    },
    methods: {
        like() {
            if (!this.$page.user) {
                window.location = '/login';
                return;
            }

            this.form.post(route(`like.store.${this.zappableType}`), {
                preserveScroll: true
            });
        }
    }
}
</script>

<style scoped>

</style>
