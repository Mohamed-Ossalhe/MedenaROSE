<template>
    <div class="col-span-full">
        <select id="select" v-on:change="onSelectChange" name="select" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            <option v-for="item in list" v-text="item.name" :value="item.name"></option>
        </select>
    </div>
</template>

<script>
export default {
    props: {
        list: Array,
        onSelectChange: Function
    }
}
</script>
