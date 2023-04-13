<template>
    <!-- Header -->
    <Header />

    <!-- Content -->
    <slot/>

    <!-- Footer -->
    <Footer/>
</template>

<script>
import Header from "@/Shared/Header/Header.vue";
import Footer from "@/Shared/Footer/Footer.vue";
export default {
    name: "DefaultLayout",
    components: {
        Header,
        Footer
    }
}
</script>

<style scoped>

</style>
