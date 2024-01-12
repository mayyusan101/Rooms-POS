<template>
    <Box>
        <template #header
            >Offer #<span class="font-bold">{{ offer.id }}</span>
            <span
                v-if="offer.accepted_at"
                class="bg-green-200 text-green-800 p-1 text-xs rounded-md ms-2"
                >Accepted</span
            >
            <span
                v-if="offer.rejected_at"
                class="bg-red-200 text-red-800 p-1 text-xs rounded-md ms-2"
                >Rejected</span
            >
        </template>
        <div>
            <Price :price="props.listingPrice" />
        </div>
        <section class="flex justify-between items-center">
            <div>
                <div class="text-sm text-gray-700">
                    Difference
                    <span class="font-bold text-blue-400">{{
                        difference
                    }}</span>
                </div>
                <div class="text-sm text-gray-700">
                    Made by
                    <span class="font-medium">{{
                        props.offer.bidder.name
                    }}</span>
                </div>
                <div class="text-sm text-gray-700">
                    Made on <span class="font-medium">{{ madeOn }}</span>
                </div>
            </div>
            <div class="pr-5">
                <Link
                    class="btn-outline"
                    :href="
                        route('realtor.offer.accept', { offer: props.offer.id })
                    "
                    method="put"
                    as="button"
                    v-if="!isSold"
                    >Accept
                </Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
import Box from "@/Components/UI/Box.vue";
import Price from "@/Components/UI/Price.vue";
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    offer: Object,
    listingPrice: Number,
    isSold: Boolean,
});

const difference = computed(() => props.listingPrice - props.offer.amount);

const madeOn = computed(() => new Date(props.offer.created_at).toDateString());

const accepetdOn = computed(() =>
    new Date(props.offer.created_at).toDateString()
);
</script>

<style lang="scss" scoped></style>
