<template>
    <div class="my-3">
        <form>
            <div class="flex items-center gap-4 cursor-pointer">
                <div class="flex items-center gap-1">
                    <input
                        type="checkbox"
                        name="delete"
                        id="delete"
                        class="h-4 w-4 text-indigo-600 rounded ring-0"
                        v-model="filterForm.delete"
                    />
                    <label for="delete">Delete</label>
                </div>
                <div>
                    <select class="filter-input-l w-28" v-model="filterForm.by">
                        <option value="created_at">Added</option>
                        <option value="price">Price</option>
                    </select>
                    <select
                        class="filter-input-r w-28"
                        v-model="filterForm.order"
                    >
                        <option
                            v-for="option in sortedOptions"
                            :value="option.value"
                            :key="option.value"
                        >
                            {{ option.label }}
                        </option>
                    </select>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, reactive, watch, computed } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({ filters: Object });

const sortLabels = {
    created_at: [
        {
            label: "Latest",
            value: "desc",
        },
        {
            label: "Oldest",
            value: "asc",
        },
    ],
    price: [
        {
            label: "Cheapest",
            value: "asc",
        },
        {
            label: "Pricey",
            value: "desc",
        },
    ],
};

const filterForm = reactive({
    delete: props.filters.delete ?? false,
    by: props.filters.by ?? "created_at",
    order: props.filters.order ?? "desc",
});

const sortedOptions = computed(() => sortLabels[filterForm.by]);

const debounce = (fn, delay) => {
    let run; // first call undefined, sec call will have setTimeout value
    return (...args) => {
        if (run) {
            clearInterval(run);
        }
        run = setTimeout(() => fn.apply(this, ...args), delay);
    };
};

watch(
    filterForm,
    debounce(() => {
        router.get(
            route("realtor.listing.index"),
            {
                delete: filterForm.delete,
                by: filterForm.by,
                order: filterForm.order,
            },
            {
                replace: true,
                preserveScroll: true,
                preserveState: true,
            }
        );
    }, 500)
);
</script>

<style lang="scss" scoped></style>
