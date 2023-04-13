<template>
    <div class="relative">
        <div class="relative w-full h-64 rounded-lg overflow-hidden">
            <img :src="imagePath + product.images[0].src" :alt="product.imageAlt" class="w-full h-full object-center object-cover" />
        </div>
        <div class="relative mt-4">
            <h3 class="text-sm font-medium text-gray-900">{{ product.name }}</h3>
            <p class="mt-1 text-sm text-gray-500">{{ product.color }}</p>
        </div>
        <div class="absolute top-0 inset-x-0 h-64 rounded-lg p-4 flex items-end justify-end overflow-hidden">
            <div aria-hidden="true" class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50" />
            <p class="relative text-lg font-semibold text-white">{{ product.price }}</p>
        </div>
    </div>
    <div class="mt-6">
        <a :href="product.href" class="relative flex bg-gray-100 border border-transparent rounded-md py-2 px-8 items-center justify-center text-sm font-medium text-gray-900 hover:bg-gray-200 cursor-pointer"
        >Add to bag<span class="sr-only">, {{ product.name }}</span></a
        >
    </div>
</template>

<script>
export default {
    name: "Product",
    props: {
        product: Object
    },
    computed: {
        imagePath() {
            return 'http://127.0.0.1:8000/storage/productImages/'
        }
    }
}
</script>

<style scoped>

</style>
