<template>
    <div>
        <ul class="flex pl-0 list-none rounded my-4 justify-between cursor-pointer">
            <InertiaLink v-if="previous_page_url" :href="previous_page_url" class="page-link">
                <li class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 border-r-0 ml-0 rounded-l hover:bg-gray-200">
                    <!-- Heroicon name: chevron-left -->
                    <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              fill-rule="evenodd"/>
                    </svg>
                </li>
            </InertiaLink>

            <inertia-link v-for="url in urls_array" :key="url.indexKey"
                          :href="url.type === 'ELIPSIS' ? '' : url.url" class="page-link w-full">
                <li :class="{ 'bg-blue-700 hover:bg-blue-600': url.isCurrentPage === true,
                    'rounded-l': (!previous_page_url && url.pageNumber === 1),
                    'rounded-r': (!next_page_url && url.pageNumber === urls_array.length)}"
                    class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 border-r-0 hover:bg-gray-200 text-center">
                    <span v-if="url.type === 'URLS'"
                          :class="{ 'text-white font-black': url.isCurrentPage === true }">{{ url.pageNumber }} </span>
                    <span v-else-if="url.type === 'ELIPSIS'">{{ url.url }}</span>
                </li>
            </inertia-link>

            <InertiaLink v-if="next_page_url" :href="next_page_url" class="page-link">
                <li class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 rounded-r hover:bg-gray-200">
                    <!-- Heroicon name: chevron-right -->
                    <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd"
                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                              fill-rule="evenodd"/>
                    </svg>
                </li>
            </InertiaLink>

        </ul>
    </div>
</template>

<script>
export default {
    props: {
        urls_array: Array,
        previous_page_url: String,
        next_page_url: String
    },
}
</script>

<style scoped>

</style>
