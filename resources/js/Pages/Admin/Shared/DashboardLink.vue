<template>
    <Link
        class="text-black hover:underline"
        :class="[active ? 'bg-primary/10 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900', 'group flex items-center my-3 px-2 py-2 text-sm font-medium rounded-md']">
        <slot/>
    </Link>
</template>

<script>
export default {
    name: "DashboardLink",
    props: {active: Boolean}
}
</script>

<style scoped>

</style>
