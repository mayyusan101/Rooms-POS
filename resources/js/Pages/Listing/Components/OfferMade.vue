<template>
    <Box>
        <template #header>Offer Made</template>

        <Price :price="props.offer.amount" />
        <section
            class="flex justify-between items-center text-gray-900 text-sm mt-2"
        >
            <div>Made on</div>
            <div>{{ offerMadeOn }}</div>
        </section>
    </Box>
</template>

<script setup>
import Price from "@/Components/UI/Price.vue";
import Box from "@/Components/UI/Box.vue";
import { computed } from "vue";

const props = defineProps({ offer: Object });

const offerMadeOn = computed(() =>
    new Date(props.offer.created_at).toDateString()
);
</script>

<style lang="scss" scoped></style>
