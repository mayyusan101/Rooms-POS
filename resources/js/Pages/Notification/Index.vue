<template>
    <div class="container mx-auto my-3 text-gray-900 text-xl">
        <div v-if="props.notifications.data.length">
            <Filters />
            <div v-for="noti in props.notifications.data">
                <div
                    :key="noti.id"
                    class="p-3 border-b-[0.5px] border-b-gray-600 flex justify-between"
                >
                    <div v-if="noti.type === 'App\\Notifications\\OfferMade'">
                        Offer
                        <Price :price="noti.data.amount" class="text-sm" />
                        for
                        <Link
                            :href="
                                route('listing.show', {
                                    listing: noti.data.listing_id,
                                })
                            "
                            class="text-indigo-500"
                            >listing</Link
                        >
                        was made
                    </div>
                    <div v-if="!noti.read_at">
                        <Link
                            :href="
                                route('notification.seen', {
                                    notification: noti.id,
                                })
                            "
                            method="put"
                            class="btn-outline text-sm"
                            as="button"
                            >Make as read</Link
                        >
                    </div>
                </div>
            </div>
        </div>

        <Box v-else> <EmptyState>No Notification</EmptyState></Box>
        <div
            v-if="props.notifications.data.length"
            class="py-2 rounded-md my-6 text-sm flex justify-center bg-purple-500"
        >
            <Pagination
                :links="props.notifications.links"
                :allNotificationsIds="allNotificationsIds"
            />
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import Price from "@/Components/UI/Price.vue";
import Pagination from "@/Components/UI/Pagination.vue";
import Filters from "@/Pages/Notification/Components/Filters.vue";
import EmptyState from "@/Components/UI/EmptyState.vue";
import Box from "@/Components/UI/Box.vue";
import { computed } from "vue";

const props = defineProps({ notifications: Object });

const allNotificationsIds = computed(() =>
    props.notifications.data?.map((noti) => noti.id)
);

</script>

<style lang="scss" scoped></style>
