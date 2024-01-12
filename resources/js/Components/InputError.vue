<template>
    <div class="text-red-500 text-sm">
        {{ error }}
    </div>
</template>

<script setup>
defineProps({ error: [String] });
</script>

<style lang="scss" scoped></style>
