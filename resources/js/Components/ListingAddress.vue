<template>
    <div class="my-2 text-gray-400 text-sm">
        {{ list.city }} | {{ list.street }}
    </div>
</template>

<script setup>
defineProps({ list: Object });
</script>

<style lang="scss" scoped></style>
