<template>
    <Head title="Customers"/>
    <div class="mt-5">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Customers</h1>
            </div>
        </div>

        <Filters :link="'/customers'" :filters="filters" :sort="sorts" />

        <div v-if="users.data.length > 0">
            <div class="h-96">
                <div class="bg-white shadow overflow-hidden sm:rounded-md">
                    <ul role="list" class="divide-y divide-gray-200">
                        <li v-for="user in users.data" :key="user.id">
                            <a href="" class="block hover:bg-gray-50">
                                <div class="flex items-center px-4 py-4 sm:px-6">
                                    <div class="min-w-0 flex-1 flex items-center">
                                        <div class="flex-shrink-0">
                                            <img class="h-12 w-12 rounded-full" :src="image + user.image" alt="add image" />
                                        </div>
                                        <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                            <div>
                                                <p class="text-sm font-medium text-indigo-600 truncate">{{ user.name }}</p>
                                                <p class="mt-2 flex items-center text-sm text-gray-500">
                                                    <MailIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                                                    <span class="truncate">{{ user.email }}</span>
                                                </p>
                                            </div>
                                            <div class="hidden md:block">
                                                <div>
                                                    <p class="text-sm text-gray-900">
                                                        Joined on
                                                        {{ ' ' }}
                                                        <time :datetime="user.joined">{{ toDate(user.joined) }}</time>
                                                    </p>
                                                    <p class="mt-2 flex items-center text-sm text-gray-500">
                                                        <CheckCircleIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400" aria-hidden="true" />
                                                        {{ user.role }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <ChevronRightIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div>
                <Pagination :links="users.links" />
            </div>
        </div>
        <NotFound v-else>No Users Found</NotFound>
    </div>
</template>

<script>
import { CheckCircleIcon, ChevronRightIcon, MailIcon } from '@heroicons/vue/solid'
import Layout from "@/Pages/Admin/Shared/Layout.vue";
import Pagination from "@/Components/Pagination.vue";
import Filters from "@/Components/Filters.vue";
import NotFound from "@/Pages/Admin/Shared/NotFound.vue";

export default {
    name: 'Customers',
    layout: Layout,
    data() {
        return {
            months: {
                '1': 'January',
                '2': 'February',
                '3': 'March',
                '4': 'April',
                '5': 'May',
                '6': 'June',
                '7': 'July',
                '8': 'August',
                '9': 'September',
                '10': 'October',
                '11': 'November',
                '12': 'December'
            },
        }
    },
    components: {
        NotFound,
        Filters,
        Pagination,
        CheckCircleIcon,
        ChevronRightIcon,
        MailIcon,
    },
    props: {
        users: Object,
        filters: Object,
        sorts: Object
    },
    methods: {
        addZeroToDate(value) {
            if(value < 10) {
                return '0' + value
            }
            return value
        },
        // TODO: Separate the search and sort code to a separate file component and recall it in other files
        setMonth(value) {
            return this.months[value]
        },

        toDate(value) {
            const date = new Date(value)
            const joinedDate = `${this.setMonth(date.getMonth())} ${this.addZeroToDate(date.getDate())}, ${date.getFullYear()} | ${date.getUTCHours() < 10 ? '0' + date.getUTCHours() : date.getUTCHours()}:${date.getUTCMinutes() < 10 ? '0' + date.getUTCMinutes() : date.getUTCMinutes()}`
            return joinedDate
        }
    },
    computed: {
        image: function () {
            return 'http://127.0.0.1:8000/storage/usersImages/';
        }
    }
}
</script>

<style scoped>

</style>
