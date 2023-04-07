<template>
    <div class="flex items-center justify-end bg-white px-4 py-3 sm:px-6">
        <div class="hidden sm:flex sm:items-center sm:justify-between">
            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->
                    <Component
                        :is="link.url ? 'Link' : 'span'"
                        v-for="link of links"
                        :href="link.url"
                        v-html="link.label"
                        :class="{'text-gray-200': !link.url, 'bg-primary text-white': link.active}"
                        aria-current="page"
                        class="relative z-10 inline-flex items-center px-4 py-2 text-sm font-semibold text-black focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    />
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Pagination",
    props: {
        links: Array
    }
}
</script>

<style scoped>

</style>
