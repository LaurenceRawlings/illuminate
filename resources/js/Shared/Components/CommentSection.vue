<template>
    <div>
        <h2 class="text-xl mt-4">{{ comments ? comments.length : 0}} Comments</h2>

        <div v-if="$page.user">
            Leave comment
        </div>
    </div>
</template>

<script>
export default {
    props: {
        comments: Array,
    }
}
</script>

<style scoped>

</style>
