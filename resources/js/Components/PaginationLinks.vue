<template>
    <div>
        <ul class="flex pl-0 list-none rounded my-4 justify-between cursor-pointer">
            <InertiaLink :href="previous_page_url" class="page-link w-full" v-if="previous_page_url">
                <li class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 border-r-0 ml-0 rounded-l hover:bg-gray-200 text-center">
                    Prev
                </li>
            </InertiaLink>

            <inertia-link :href="url.type === 'ELIPSIS' ? '' : url.url" class="page-link w-full" v-for="url in urls_array" :key="url.indexKey">
                <li class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 border-r-0 hover:bg-gray-200 text-center"
                    :class="{ 'bg-blue-700 hover:bg-blue-600': url.isCurrentPage === true,
                    'rounded-l': (!previous_page_url && url.pageNumber === 1),
                    'rounded-r': (!next_page_url && url.pageNumber === urls_array.length)}">
                    <span v-if="url.type === 'URLS'"
                          :class="{ 'text-white font-black': url.isCurrentPage === true }">{{ url.pageNumber }} </span>
                    <span v-else-if="url.type === 'ELIPSIS'">{{ url.url }}</span>
                </li>
            </inertia-link>

            <InertiaLink :href="next_page_url" class="page-link w-full" v-if="next_page_url">
                <li class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 rounded-r hover:bg-gray-200 text-center">
                    Next
                </li>
            </InertiaLink>

        </ul>
    </div>
</template>

<script>
export default {
    props: ['urls_array', 'previous_page_url', 'next_page_url'],
}
</script>

<style scoped>

</style>
