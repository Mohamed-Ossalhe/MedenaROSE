<template>
    <Link :href="'/our-products/' + product.id">
        <div class="relative">
            <div class="absolute top-2 left-2 z-10 rounded-xl text-sm px-2 py-1" :class="product.quantity > 0 ? 'text-green-900 bg-green-100' : 'text-red-900 bg-red-100'" v-text="product.quantity > 0 ? 'In Stock' : 'Out Of Stock'"></div>
                <div class="relative w-full h-64 rounded-lg overflow-hidden">
                    <img :src="imagePath + product.images[0].src" :alt="product.imageAlt" class="w-full h-full object-center object-cover" />
                </div>
            <div class="relative mt-4">
                <h3 class="text-sm font-medium text-gray-900">{{ product.name }}</h3>
                <p class="mt-1 text-sm text-gray-500">{{ product.color }}</p>
            </div>
            <div class="absolute top-0 inset-x-0 h-64 rounded-lg p-4 flex items-end justify-end overflow-hidden">
                <div aria-hidden="true" class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50" />
                <p class="relative text-lg font-semibold text-white">{{ product.price }} dh</p>
            </div>
        </div>
    </Link>
    <div class="mt-6">
        <Link @click="addToCart" class="relative w-full flex bg-gray-100 border border-transparent rounded-md py-2 px-8 items-center justify-center text-sm font-medium text-gray-900 hover:bg-gray-200 cursor-pointer"
        :class="product.quantity > 0 ? 'cursor-pointer':'cursor-not-allowed'">add to cart<span class="sr-only">, {{ product.name }}</span></Link
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
    },
    methods: {
        addToCart() {
            this.$inertia.post('/cart', {
                id: this.product.id,
                quantity: 1
            }, {
                preserveState: true,
                preserveScroll: true
            })
        }
    }
}
</script>

<style scoped>

</style>
