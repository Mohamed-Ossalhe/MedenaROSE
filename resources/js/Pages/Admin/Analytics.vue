<template>
    <Head title="Analytics"/>
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
                        <div v-if="item.href" class="text-sm">
                            <a :href="item.href" class="font-medium text-indigo-600 hover:text-indigo-500">
                                View all<span class="sr-only"> {{ item.name }} stats</span></a
                            >
                        </div>
                    </div>
                </dd>
            </div>
        </dl>
    </div>
    <Bar
        id="my-chart-id"
        :options="chartOptions"
        :data="chartData"
    />
</template>

<script>
import { ArrowSmDownIcon, ArrowSmUpIcon } from '@heroicons/vue/solid'
import { CursorClickIcon, MailOpenIcon, UsersIcon } from '@heroicons/vue/outline'
import Layout from "@/Pages/Admin/Shared/Layout.vue";
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
    name: 'Analytics',
    layout: Layout,
    data() {
        return {
            stats: [
                { id: 1, name: 'Total Clients', stat: this.clients.total, icon: UsersIcon, href: '/admin/customers' },
                { id: 2, name: 'Total Orders', stat: this.totalOrders.total, icon: MailOpenIcon, href: '/admin/orders'},
                { id: 3, name: 'Total Visitors', stat: this.visitors.total, icon: CursorClickIcon},
            ],
            chartData: {
                labels: [...Object.keys(this.ordersByMonth)],
                datasets: [ {
                    label: 'Orders By Month',
                    data: [Object.values(this.ordersByMonth)],
                    backgroundColor: '#9BD0F5'
                } ]
            },
            chartOptions: {
                responsive: true,
                beginAtZero: true
            },
        }
    },
    components: {
        ArrowSmDownIcon,
        ArrowSmUpIcon,
        Bar
    },
    props: {
        visitors: Object,
        totalOrders: Object,
        clients: Object,
        ordersByMonth: Object
    }
}
</script>

<style scoped>

</style>
