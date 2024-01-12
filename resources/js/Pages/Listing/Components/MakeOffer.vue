<template>
    <Box>
        <template #header>Make an Offer</template>
        <form @submit.prevent="makeOffer">
            <input
                type="text"
                class="h-8 mt-2 text-gray-900"
                v-model.number="form.amount"
            />
            <input
                v-model.number="form.amount"
                type="range"
                :min="min"
                :max="max"
                step="1000"
                class="bg-gray-200 w-full h-3 rounded-full appearance-none cursor-pointer mt-4"
            />
            <button class="btn-outline mt-2 w-full text-gray-900" type="submit">
                Make an Offer
            </button>
        </form>
        <div
            class="flex justify-between items-center text-gray-900 text-sm mt-2"
        >
            <div>Difference</div>
            <Price :price="difference" />
        </div>
    </Box>
</template>

<script setup>
import Price from "@/Components/UI/Price.vue";
import Box from "@/Components/UI/Box.vue";
import { useForm } from "@inertiajs/vue3";
import { computed, watch } from "vue";

const props = defineProps({ listingId: Number, price: Number });

const form = useForm({
    amount: props.price,
});

const emit = defineEmits(["offerUpdate"]);

watch(
    () => form.amount,
    (value) => emit("offerUpdate", value)
);

const min = computed(() => Math.round(props.price / 2));
const max = computed(() => Math.round(props.price * 2));

const difference = computed(() => form.amount - props.price);

const makeOffer = () =>
    form.post(
        route("listing.offer.store", {
            listing: props.listingId,
        }),
        {
            preserveScroll: true,
            preserveState: true,
        }
    );
</script>

<style lang="scss" scoped></style>
