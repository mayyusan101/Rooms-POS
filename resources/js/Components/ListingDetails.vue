<template>
    <div>
        <span class="font-bold">{{ list.beds }}</span> beds
        <span class="text-gray-700">| </span>
        <span class="font-bold">{{ list.baths }}</span> bths
        <span class="text-gray-700">| </span>
        <span class="font-bold">{{ list.area }}</span> m2
    </div>
</template>

<script setup>
defineProps({ list: Object });
</script>

<style lang="scss" scoped></style>
