<template>
    <div class="text-center relative bottom-0">
        <p>Copyright &copy; 2022 - {{ date.getFullYear() }} | <span class="text-primary">MedenaRose</span> | All Rights Reserved</p>
    </div>
</template>

<script>
export default {
    name: "Footer",
    data() {
        return {
            date: new Date()
        }
    }
}
</script>

<style scoped>

</style>
