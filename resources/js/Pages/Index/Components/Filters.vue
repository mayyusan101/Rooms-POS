<template>
    <div class="my-6">
        <form @submit.prevent="filter">
            <div class="flex flex-wrap gap-2">
                <div class="flex flex-nowrap">
                    <input
                        type="text"
                        placeholder="Price from"
                        class="filter-input-l"
                        v-model.number="form.priceFrom"
                    />
                    <input
                        type="text"
                        placeholder="Price to"
                        class="filter-input-r"
                        v-model.number="form.priceTo"
                    />
                </div>
                <div class="flex flex-nowrap">
                    <select
                        name="bed"
                        class="filter-input-l"
                        v-model="form.beds"
                    >
                        <option :value="null" class="text-gray-400">
                            Beds
                        </option>
                        <option v-for="n in 5" :key="n" :value="n">
                            {{ n }}
                        </option>
                    </select>
                    <select
                        name="bath"
                        class="filter-input-r"
                        v-model="form.baths"
                    >
                        <option :value="null" class="text-gray-400">
                            Baths
                        </option>
                        <option v-for="n in 5" :key="n" :value="n">
                            {{ n }}
                        </option>
                    </select>
                </div>
                <div class="flex flex-nowrap">
                    <input
                        type="text"
                        placeholder="Area from"
                        class="filter-input-l"
                        v-model.number="form.areaFrom"
                    />
                    <input
                        type="text"
                        placeholder="Area to"
                        class="filter-input-r"
                        v-model.number="form.areaTo"
                    />
                </div>
                <div class="flex flex-nowrap">
                    <button class="btn-secondary me-1" type="submit">
                        Filter
                    </button>
                    <button class="btn-secondary" type="reset" @click="clear">
                        Clear
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({ filters: Object });

// copy url and passed to others
const form = useForm({
    beds: props.filters.beds ?? null,
    baths: props.filters.baths ?? null,
    priceFrom: props.filters.priceFrom ?? null,
    priceTo: props.filters.priceTo ?? null,
    areaFrom: props.filters.areaFrom ?? null,
    areaTo: props.filters.areaTo ?? null,
});

const filter = () =>
    form.get(route("listing.index"), {
        preserveState: true,
        preserveScroll: true,
    });

const clear = () => {
    form.beds = null;
    form.baths = null;
    form.priceFrom = null;
    form.priceTo = null;
    form.areaFrom = null;
    form.areaTo = null;
};
</script>

<style lang="scss" scoped></style>
