<template>
    <div>
        <dl class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div v-for="item in stats" :key="item.id" class="relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 shadow rounded-lg overflow-hidden">
                <dt>
                    <div class="absolute bg-indigo-500 rounded-md p-3">
                        <component :is="item.icon" class="h-6 w-6 text-white" aria-hidden="true" />
                    </div>
                    <p class="ml-16 text-sm font-medium text-gray-500 truncate">{{ item.name }}</p>
                </dt>
                <dd class="ml-16 pb-6 flex items-baseline sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">
                        {{ item.stat }}
                    </p>
                    <p :class="[item.changeType === 'increase' ? 'text-green-600' : 'text-red-600', 'ml-2 flex items-baseline text-sm font-semibold']">
                    </p>
                    <div class="absolute bottom-0 inset-x-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                View all<span class="sr-only"> {{ item.name }} stats</span></a
                            >
                        </div>
                    </div>
                </dd>
            </div>
        </dl>
    </div>
</template>

<script>
import { ArrowSmDownIcon, ArrowSmUpIcon } from '@heroicons/vue/solid'
import { CursorClickIcon, MailOpenIcon, UsersIcon } from '@heroicons/vue/outline'
import Layout from "@/Pages/Admin/Shared/Layout.vue";

export default {
    name: 'Analytics',
    layout: Layout,
    data() {
        return {
            stats: [
                { id: 1, name: 'Total Visitors', stat: this.visitors.total, icon: UsersIcon },
                { id: 2, name: 'Most Sold Product', stat: 'Product 1', icon: MailOpenIcon},
                { id: 3, name: 'Less Sold Product', stat: 'Product 2', icon: CursorClickIcon},
            ]
        }
    },
    components: {
        ArrowSmDownIcon,
        ArrowSmUpIcon,
    },
    props: {
        visitors: Object
    },
    computed: {
        totalVisitors() {
            return this.visitors.total
        }
    }
}
</script>

<style scoped>

</style>
