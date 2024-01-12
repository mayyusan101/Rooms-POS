<template>
    <div class="bg-white w-full">
        <div class="container mx-auto bg-green-100 text-gray-900">
            <h1 class="p-3 text-2xl">Your Listings</h1>
            <RealtorFilter :filters="filters" />
            <section
                v-if="listings.data"
                class="grid grid-cols-1 md:grid-cols-2 gap-4"
            >
                <Box
                    v-for="list in listings.data"
                    class="bg-slate-50"
                    :class="{ 'border-dashed': list.deleted_at }"
                    :key="list.id"
                >
                    <div
                        :class="{ 'opacity-40': list.deleted_at }"
                        class="flex flex-col lg:flex-row lg:items-center justify-between gap-2"
                    >
                        <div>
                            <div
                                v-if="list.sold_at != null"
                                class="p-1 text-xs text-green-600 border-green-900 border border-dashed rounded-md font-medium inline-block mb-2"
                            >
                                Sold
                            </div>
                            <div
                                class="flex flex-col xl:flex-row items-start xl:items-center gap-2"
                            >
                                <Price :price="list.price" />
                                <ListingDetails :list="list" />
                            </div>
                            <ListingAddress
                                :list="list"
                                class="text-gray-900"
                            />
                        </div>
                        <section>
                            <div
                                class="flex gap-1 flex-wrap justify-end lg:justify-start"
                            >
                                <Link
                                    class="btn-outline"
                                    :href="
                                        route('listing.show', {
                                            listing: list.id,
                                        })
                                    "
                                    >Preview</Link
                                >
                                <a
                                    :href="
                                        route('realtor.listing.edit', {
                                            listing: list.id,
                                        })
                                    "
                                    target="_blank"
                                    class="btn-outline"
                                    >Edit</a
                                >
                                <Link
                                    v-if="!list.deleted_at"
                                    :href="
                                        route('realtor.listing.destroy', {
                                            listing: list.id,
                                        })
                                    "
                                    class="btn-outline"
                                    method="delete"
                                    as="button"
                                    >Delete</Link
                                >
                                <Link
                                    v-else
                                    class="btn-outline"
                                    method="put"
                                    as="button"
                                    :href="
                                        route('realtor.listing.restore', {
                                            listing: list.id,
                                        })
                                    "
                                    >Restore</Link
                                >
                            </div>
                            <Link
                                class="w-full block text-center mt-2 btn-outline"
                                as="button"
                                :href="
                                    route('realtor.listing.image.create', {
                                        listing: list.id,
                                    })
                                "
                                >Images ({{ list.images_count }})
                            </Link>
                            <Link
                                class="w-full block text-center mt-2 btn-outline"
                                as="button"
                                :href="
                                    route('realtor.listing.show', {
                                        listing: list.id,
                                    })
                                "
                                >Offers ({{ list.offers_count }})
                            </Link>
                        </section>
                    </div>
                </Box>
            </section>
            <Box>
                <EmptyState>No Listing Yet</EmptyState>
            </Box>
            <section>
                <div
                    v-if="listings.data.length"
                    class="flex justify-center bg-green-400 py-2 rounded-md my-5"
                >
                    <Pagination :links="listings.links" :realtor="true" />
                </div>
            </section>
        </div>
    </div>
</template>

<script setup>
import Box from "@/Components/UI/Box.vue";
import Price from "@/Components/UI/Price.vue";
import ListingDetails from "@/Components/ListingDetails.vue";
import ListingAddress from "@/Components/ListingAddress.vue";
import RealtorFilter from "@/Pages/Realtor/Index/Components/RealtorFilter.vue";
import { Link } from "@inertiajs/vue3";
import Pagination from "@/Components/UI/Pagination.vue";
import EmptyState from "@/Components/UI/EmptyState.vue";

defineProps({ listings: Object, filters: Object });


</script>

<style lang="scss" scoped></style>
