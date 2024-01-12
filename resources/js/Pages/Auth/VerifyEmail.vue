<template>
    <div class="container mx-auto text-gray-900">
        <h2 class="text-medium my-5">You need to verify email</h2>
        <h2 class="text-medium my-5">
            Email Verification link was sent to your -
            <span class="font-medium">{{ email }}</span>
        </h2>
        <Link
            :href="route('verification.send')"
            method="post"
            as="button"
            class="btn-outline"
            >Resent Email</Link
        >
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
const page = usePage();

const email = computed(() => page.props.user.email);
</script>

<style lang="scss" scoped></style>
