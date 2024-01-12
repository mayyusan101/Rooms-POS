<template>
    <div class="bg-gray-900 py-3">
        <div class="container mx-auto">
            <Filters :filters="props.filters" />
            <div
                class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 p-0"
            >
                <List
                    v-for="list in props.lists.data"
                    :key="list.id"
                    :list="list"
                />
            </div>
            <div
                v-if="props.lists.data.length"
                class="py-4 flex justify-center"
            >
                <Pagination :links="props.lists.links" />
            </div>
        </div>
    </div>
</template>

<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import List from "@/Pages/Index/Components/List.vue";
import Pagination from "@/Components/UI/Pagination.vue";
import Filters from "@/Pages/Index/Components/Filters.vue";

defineOptions({ layout: MainLayout });
const props = defineProps({ lists: Object, filters: Object });
</script>

<style lang="scss" scoped></style>
