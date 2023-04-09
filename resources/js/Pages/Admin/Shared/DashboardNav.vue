<template>
    <nav class="mt-5 flex-1 px-2 bg-white space-y-1">
        <DashboardLink v-for="item in navigation" :key="item.title" :href="item.href" :active="$page.component === item.name">
            <component :is="item.icon" :class="[item.current ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500', 'mr-3 flex-shrink-0 h-6 w-6']" aria-hidden="true" />
            {{ item.title }}
        </DashboardLink>
    </nav>
</template>

<script>

import {
    ChartPieIcon,
    HomeIcon, LogoutIcon, MenuIcon,
    ShoppingBagIcon,
    ShoppingCartIcon,
    UsersIcon,
    ViewGridIcon, XIcon
} from "@heroicons/vue/outline";
import {Dialog, DialogOverlay, TransitionChild, TransitionRoot} from "@headlessui/vue";
import DashboardLink from "@/Pages/Admin/Shared/DashboardLink.vue";

const navigation = [
    { name: 'Admin/Dashboard', title:'Dashboard', href: '/dashboard', icon: HomeIcon, current: false },
    { name: 'Admin/Analytics', title:'Analytics', href: '/analytics', icon: ChartPieIcon, current: false },
    { name: 'Admin/Products', title:'Products', href: '/products', icon: ShoppingCartIcon, current: false },
    { name: 'Admin/Customers', title:'Customers', href: '/customers', icon: UsersIcon, current: false },
    { name: 'Admin/Categories', title:'Categories', href: '/categories', icon: ViewGridIcon, current: false },
    { name: 'Admin/Orders', title:'Orders', href: '/orders', icon: ShoppingBagIcon, current: false },
]
export default {
    name: "DashboardNav",
    components: {
        DashboardLink,
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        MenuIcon,
        XIcon,
        LogoutIcon
    },
    setup() {
        return {
            navigation
        }
    }
}
</script>

<style scoped>

</style>
