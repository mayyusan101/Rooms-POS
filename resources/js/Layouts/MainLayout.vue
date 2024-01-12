<template>
    <header class="w-full bg-white border border-gray-300 shadow-sm">
        <div class="container mx-auto bg-white w-full">
            <div class="flex items-center justify-between w-full flex-wrap p-4">
                <Link
                    :href="route('listing.index')"
                    class="font-semibold text-gray-700"
                    >Home page</Link
                >
                <Link
                    :href="route('listing.index')"
                    class="font-bold text-indigo-700 text-lg"
                    >LaraZillow</Link
                >
                <div class="flex items-center gap-4" v-if="user">
                    <Link
                        :href="route('notifications.index')"
                        class="relative pr-2 pt-2 text-lg"
                    >
                        🔔
                        <div
                            class="absolute top-0 right-0 w-5 h-5 bg-red-700 text-white-rounded text-xs text-center font-medium rounded-full"
                        >
                            {{ notificationCount }}
                        </div>
                    </Link>
                    <Link
                        :href="route('realtor.listing.index')"
                        class="text-sm text-gray-700"
                        >{{ user.name }}</Link
                    >
                    <Link
                        :href="route('realtor.listing.create')"
                        class="btn-primary block"
                        >+NewListing</Link
                    >
                    <Link
                        class="btn-primary bg-red-600 hover:bg-red-500 cursor-pointer"
                        :href="route('logout')"
                        method="post"
                        as="button"
                    >
                        Logout
                    </Link>
                </div>
                <div v-else>
                    <Link
                        class="btn-primary cursor-pointer me-4"
                        :href="route('user-account.create')"
                        >Register</Link
                    >
                    <Link
                        class="btn-primary cursor-pointer"
                        :href="route('login')"
                        >Singin</Link
                    >
                </div>
            </div>
        </div>
    </header>
    <div v-show="flashMessage" class="bg-slate-50 container mx-auto w-full">
        <div class="py-3">
            <div
                class="p-2 bg-green-100 text-gray-700 rounded border border-green-400"
            >
                {{ flashMessage }}
            </div>
        </div>
    </div>
    <slot></slot>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
const page = usePage();

const flashMessage = computed(() => page.props.flash.message);

const user = computed(() => page.props.user);

const notificationCount = computed(
    () => Math.min(page.props.user.notificationCount, 9) // showing not more than 9
);
</script>

<style lang="scss" scoped></style>
