<template>
    <Box>
        <Link :href="route('listing.show', { listing: list.id })">
            <div class="flex gap-2 items-center">
                <Price :price="list.price" class="text-slate-300" />
                <div class="text-xs text-gray-400 font-medium">
                    <Price :price="monthlyPayment" class="text-slate-300" /> pm
                </div>
            </div>
            <ListingDetails :list="list" />
            <ListingAddress :list="list"
        /></Link>
    </Box>
</template>

<script setup>
import Box from "@/Components/UI/Box.vue";
import ListingDetails from "@/Components/ListingDetails.vue";
import ListingAddress from "@/Components/ListingAddress.vue";
import Price from "@/Components/UI/Price.vue";
import { Link } from "@inertiajs/vue3";
import { useMonthlyPayment } from "@/Composable/useMonthlyPayment.js";
const props = defineProps({ list: Object });

const { monthlyPayment } = useMonthlyPayment(props.list.price, 2.5, 25);
</script>

<style lang="scss" scoped></style>
