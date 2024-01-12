<template>
    <div class="container mx-auto">
        <div
            class="flex flex-col-reverse md:grid grid-cols-12 gap-4 p-2 w-full"
        >
            <Box
                class="col-span-12 md:col-span-7 flex justify-center items-start"
            >
                <div
                    v-if="list.images.length"
                    class="grid grid-cols-1 sm:grid-cols-2 gap-1"
                >
                    <img
                        v-for="image in list.images"
                        :key="image.id"
                        :src="image.src"
                    />
                </div>
                <EmptyState v-else>No images</EmptyState>
            </Box>
            <div class="flex flex-col md:col-span-5">
                <Box>
                    <template #header> Basic info </template>
                    <Price :price="list.price" class="font-bold text-xl" />
                    <ListingDetails
                        :list="list"
                        class="text-base text-gray-900"
                    />
                    <ListingAddress
                        :list="list"
                        class="text-green-300 text-sm"
                    />
                </Box>
                <Box>
                    <template #header>
                        <div>Monthly Payment</div>
                    </template>
                    <div class="">
                        <label class="label"
                            >Interest rate ({{ interestRate }}%)</label
                        >
                        <input
                            v-model.number="interestRate"
                            type="range"
                            min="0.1"
                            max="30"
                            step="0.1"
                            class="bg-gray-200 w-full h-3 rounded-full appearance-none cursor-pointer"
                        />
                    </div>
                    <div class="">
                        <label class="label"
                            >Duration ({{ duration }} years)</label
                        >
                        <input
                            v-model.number="duration"
                            type="range"
                            min="3"
                            max="35"
                            step="1"
                            class="bg-gray-200 w-full h-3 rounded-full appearance-none cursor-pointer"
                        />
                    </div>
                    <div class="mt-2">
                        <div class="text-gray-400">Your monthly payment</div>
                        <Price :price="monthlyPayment" />
                    </div>
                    <div
                        class="flex justify-between items-center text-gray-900 text-sm"
                    >
                        <div>Total paid</div>
                        <Price :price="totalPaid" />
                    </div>
                    <div
                        class="flex justify-between items-center text-gray-900 text-sm"
                    >
                        <div>Principal paid</div>
                        <Price :price="props.list.price" />
                    </div>
                    <div
                        class="flex justify-between items-center text-gray-900 text-sm"
                    >
                        <div>Interest paid</div>
                        <Price :price="totalPaid" />
                    </div>
                </Box>

                <MakeOffer
                    v-if="user && !props.offerMade"
                    :listing-id="props.list.id"
                    :price="list.price"
                    @offer-update="offer = $event"
                />
                <OfferMade
                    v-if="user && props.offerMade && !sold"
                    :offer="props.offerMade"
                />
                <Box v-if="user && sold" class="text-gray-900 font-medium">
                    Offer Colsed
                </Box>
            </div>
        </div>
    </div>
</template>

<script setup>
import ListingAddress from "@/Components/ListingAddress.vue";
import Box from "@/Components/UI/Box.vue";
import ListingDetails from "@/Components/ListingDetails.vue";
import Price from "@/Components/UI/Price.vue";
import MakeOffer from "@/Pages/Listing/Components/MakeOffer.vue";
import OfferMade from "@/Pages/Listing/Components/OfferMade.vue";
import { ref } from "vue";
import { useMonthlyPayment } from "@/Composable/useMonthlyPayment.js";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import EmptyState from "@/Components/UI/EmptyState.vue";

const props = defineProps({ list: Object, offerMade: Object });

const interestRate = ref(2.5);
const duration = ref(25);

const offer = ref(props.list.price);

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(
    offer,
    interestRate,
    duration
);

const page = usePage();
const user = computed(() => page.props.user);

const sold = computed(() => !!props.list.sold_at);
</script>

<style lang="scss" scoped></style>
