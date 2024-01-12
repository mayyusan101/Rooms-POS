<template>
    <div class="flex gap-1 text-white">
        <Link
            v-for="(link, index) in links"
            :key="index"
            class="py-2 px-4 rounded-md"
            :class="[link.active ? [bgActiveColor, textColor] : '']"
            :href="link.url ?? ''"
            v-html="link.label"
        />
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    links: Array,
    realtor: {
        type: Boolean,
        default: false,
    },
});

const bgActiveColor = computed(() =>
    props.realtor ? "bg-white" : "bg-indigo-600"
);

const textColor = computed(() =>
    props.realtor ? "text-green-600" : "text-white"
);
</script>

<style lang="scss" scoped></style>
