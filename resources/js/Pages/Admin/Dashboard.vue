<template>
    <div class="grid grid-cols-5 gap-3">
        <div class="bg-white overflow-hidden shadow sm:rounded-lg col-span-3">
            <div class="px-4 py-5 sm:p-6">
                <img class="h-52 w-full" :src="welcomeImage" alt="">
                <h1 class="text-2xl">Welcome to <span class="text-primary font-medium">MedenaROSE</span>, Mohamed!</h1>
            </div>
        </div>
        <div class="bg-primary flex text-white overflow-hidden shadow sm:rounded-lg col-span-1">
            <div class="px-4 py-5 sm:p-6 flex flex-col justify-end">
                <div class="h-32">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-28 h-28 opacity-50">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                    </svg>
                </div>
                <span class="text-5xl font-medium mb-2">05</span>
                <p class="text-md capitalize">waiting orders</p>
            </div>
        </div>
        <div class="bg-white flex text-primary overflow-hidden shadow sm:rounded-lg col-span-1">
            <div class="px-4 py-5 sm:p-6 flex flex-col justify-end">
                <div class="h-32">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-28 h-28 opacity-50">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                    </svg>
                </div>
                <span class="text-5xl font-medium mb-2">05</span>
                <p class="text-md capitalize">shipped orders</p>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4 mt-5">
        <div class="col-span-2 grid grid-cols-2 gap-5">
            <div class="bg-white text-primary overflow-hidden shadow sm:rounded-lg col-span-1">
                <div class="px-4 py-5 sm:p-6 flex flex-col justify-end">
                    <div class="h-32 flex justify-between w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-28 h-28 text-primary/50">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                        </svg>
                    </div>
                    <div class="flex justify-between items-end">
                        <div>
                            <p class="text-md capitalize">Today's Earnings</p>
                            <span class="text-4xl font-medium mb-2">$500.98</span>
                        </div>
                        <a href="#">View All &rarr;</a>
                    </div>
                </div>
            </div>
            <div class="bg-white text-primary overflow-hidden shadow sm:rounded-lg col-span-1">
                <div class="px-4 py-5 sm:p-6 flex flex-col justify-end">
                    <div class="h-32 flex justify-between w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-28 h-28 text-primary/50">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                        </svg>
                    </div>
                    <div class="flex justify-between items-end">
                        <div>
                            <p class="text-md capitalize">Yesterday's Earnings</p>
                            <span class="text-4xl font-medium mb-2">$500.98</span>
                        </div>
                        <a href="#">View All &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div v-for="item in items" :key="item.id" class="flex items-end justify-between mb-5 px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        {{ item.title }}
                    </dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                        {{ item.state }}
                    </dd>
                </div>
                <a :href="item.href" class="text-sm">View All &rarr;</a>
            </div>
        </div>
    </div>
</template>

<script>
import {ArrowSmDownIcon, ArrowSmUpIcon} from '@heroicons/vue/solid'
import Layout from "@/Pages/Admin/Shared/Layout.vue";
import welcomeImage from '../../../assets/Dashboard/welcome.jpg';

const items = [
    { id: 1, title: "Today's Orders", state: 5, href: '#'},
    { id: 2, title: "Yesterday's Orders", state: 5, href: '#'}
]

export default {
    layout: Layout,
    data() {
        return {
            welcomeImage: welcomeImage
        }
    },
    components: {
        ArrowSmDownIcon,
        ArrowSmUpIcon,
    },
    setup() {
        return {
            items
        }
    },
}
</script>

<style scoped>

</style>
