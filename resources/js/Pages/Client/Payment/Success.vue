<template>
    <section class="flex items-center justify-center">
        <div class="flex flex-col items-center justify-center gap-3">
            <img class="h-96" :src="successImage" alt="payment success">
            <h1 class="text-2xl text-primary">Your Order Placed Successfully!</h1>
            <Link href="/our-products" class="py-2 px-4 bg-primary hover:bg-primary/80 focus:ring-primary/50 text-white rounded">Go Back &rarr;</Link>
        </div>
    </section>
</template>

<script>
import successImage from "../../../../assets/payment/success.jpg";
import DefaultLayout from "@/Pages/Client/Shared/DefaultLayout.vue";
export default {
    name: "Success",
    layout: DefaultLayout,
    setup() {
        return {
            successImage
        }
    }
}
</script>

<style scoped>

</style>
