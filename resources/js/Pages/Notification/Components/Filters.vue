<template>
    <div class="my-3">
        <form @submit.prevent="deleteAll">
            <div class="flex items-center gap-4 cursor-pointer">
                <div class="flex items-center gap-1">
                    <input
                        type="checkbox"
                        name="delete"
                        id="delete"
                        class="h-4 w-4 text-indigo-600 rounded ring-0"
                        v-model="filterForm.delete"
                    />
                    <label for="delete" class="text-sm">Check All</label>
                    <button class="btn-outline text-sm ms-2">Delete</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>

import { reactive } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({ allNotificationsIds: Array });
const filterForm = reactive({
    delete: false,
});

const deleteAll = async () => {
    await router.post(
        route("notifications.all.delete"),
        {
            delete: filterForm.delete,
            ids: JSON.stringify(props.allNotificationsIds),
        },
        {
            replace: true,
            preserveScroll: true,
            preserveState: true,
        }
    );
    filterForm.delete = true;
};

</script>

<style lang="scss" scoped></style>
