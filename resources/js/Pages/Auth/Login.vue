<template>
    <div class="p-4">
        <form @submit.prevent="login">
            <div class="w-1/2 mx-auto">
                <div>
                    <label for="email" class="label">Email</label>
                    <input
                        type="text"
                        class="input"
                        name="email"
                        v-model="form.email"
                    />
                    <InputError
                        v-show="form.errors.email"
                        :error="form.errors.email"
                    />
                </div>
                <div class="mt-4">
                    <label for="password" class="label">Password</label>
                    <input
                        type="text"
                        class="input"
                        name="password"
                        v-model="form.password"
                    />
                    <InputError
                        v-show="form.errors.password"
                        :error="form.errors.password"
                    />
                </div>
                <div class="mt-4">
                    <button
                        class="btn-primary w-full text-center"
                        :disabled="form.processing"
                        type="submit"
                    >
                        Login
                    </button>
                </div>
                <div class="mt-2 text-gray-800 text-sm text-center">
                    Need an account?
                    <Link :href="route('user-account.create')">
                        Click here</Link
                    >
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

const form = useForm({
    email: "",
    password: "",
});

const login = () => form.post(route("login.store"));
</script>

<style lang="scss" scoped></style>
