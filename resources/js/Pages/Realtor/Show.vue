<template>
    <div class="container mx-auto text-gray-900">
        <div class="my-4">
            <Link :href="route('realtor.listing.index')">
                &lt;- Go back to listing</Link
            >
        </div>
        <section class="flex flex-col-reverse md:grid grid-cols-12 gap-4">
            <Box v-if="!hasOffer" class="flex md:col-span-7 items-center">
                <div class="w-full text-center font-medium">No Offer</div>
            </Box>
            <div v-else class="md:col-span-7 items-center">
                <Offer
                    v-for="offer in otherOffers"
                    :key="offer.id"
                    :offer="offer"
                    :listing-price="listing.price"
                    class="mb-4"
                    :is-sold="listing.sold_at !== null"
                />
            </div>
            <div class="md:col-span-5">
                <Box class="mb-3">
                    <template #header>Basic Info</template>
                    <Price :price="listing.price" />
                    <ListingDetails :list="listing" />
                    <ListingAddress :list="listing" class="text-gray-900" />
                </Box>
                <Offer
                    v-if="acceptedOffer"
                    :offer="acceptedOffer"
                    :listing-price="listing.price"
                    class="mb-4"
                    :is-sold="listing.sold_at !== null"
                />
            </div>
        </section>
    </div>
</template>

<script setup>
import Box from "@/Components/UI/Box.vue";
import ListingDetails from "@/Components/ListingDetails.vue";
import ListingAddress from "@/Components/ListingAddress.vue";
import Price from "@/Components/UI/Price.vue";
import Offer from "@/Pages/Realtor/Show/Components/Offer.vue";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({ listing: Object });

const hasOffer = computed(() => props.listing.offers.length);

const acceptedOffer = computed(
    () => props.listing.offers?.filter((offer) => offer.accepted_at !== null)[0]
);

const otherOffers = computed(() =>
    props.listing.offers?.filter((offer) => offer.accepted_at === null)
);
</script>

<style lang="scss" scoped></style>
