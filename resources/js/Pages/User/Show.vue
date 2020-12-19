<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User
            </h2>
        </template>


    </app-layout>
</template>

<script>
import AppLayout from '@/Shared/Layouts/AppLayout'

export default {
    components: {
        AppLayout,
    },
    props: {
        user: Object,
        profile: Object,
    },
}
</script>
