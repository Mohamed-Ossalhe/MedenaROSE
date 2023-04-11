<template>
    <div class="my-5">
        <div class="flex items-center justify-between">
            <div class="col-span-full">
                <label for="category" class="block text-sm font-medium text-gray-700">Sort</label>
                <select id="category" v-on:change="onSelectChange" name="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option v-for="option in sortOptions" v-text="option.name" :value="option.value"></option>
                </select>
            </div>
            <div>
                <div>
                    <div class="mt-1 relative flex items-center">
                        <input v-model="search" type="text" name="search" id="search" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="Search Products..." />
                        <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                            <kbd class="inline-flex items-center border border-gray-200 rounded px-2 text-sm font-sans font-medium text-gray-400"> ⌘K </kbd>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import {debounce} from "lodash";
import {ref, watch} from "vue";

const sortOptions = [
    { name: 'Name A -> Z', value: 'name_asc' },
    { name: 'Name Z -> A', value: 'name_desc' },
    { name: 'Price 0 -> 10', value: 'price_desc'},
    { name: 'Price 10 -> 0', value: 'price_asc'}
]
export default {
    name: "Filters",
    data() {
        return {
            search: ref(this.filters.search),
            sort: ref('')
        }
    },
    methods: {
        onSelectChange(e) {
            this.sort = e.target.value
        }
    },
    props: {
        filters: Object,
        sort: Object,
        link: String
    },
    watch: {
        search: debounce(function (value) {
            this.$inertia.get( '/admin' + this.link, {search: value}, {
                preserveState: true,
                replace: false
            })
        }, 300),
        sort: debounce(function (value) {
            this.$inertia.get('/admin' + this.link, {sort: value}, {
                preserveState: true,
                replace: false
            })
        }, 300)
    },
    setup() {
        return {
            sortOptions
        }
    }
}
</script>

<style scoped>

</style>
