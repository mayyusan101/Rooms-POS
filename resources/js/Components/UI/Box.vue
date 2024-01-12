<template>
    <div class="border border-gray-500 p-4 shadow-sm rounded container mx-auto">
        <div class="text-gray-700 font-medium">
            <slot name="header" />
        </div>

        <slot />
    </div>
</template>

<script setup></script>

<style lang="scss" scoped></style>
