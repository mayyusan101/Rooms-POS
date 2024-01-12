<template>
    <div class="p-4">
        <form @submit.prevent="register">
            <div class="w-1/2 mx-auto">
                <div class="mb-2">
                    <label for="name" class="label">Your name</label>
                    <input
                        type="text"
                        class="input"
                        name="name"
                        v-model="form.name"
                    />
                    <InputError
                        v-show="form.errors.name"
                        :error="form.errors.name"
                    />
                </div>
                <div class="mb-2">
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
                <div class="mb-2">
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
                <div class="mb-2">
                    <label for="password" class="label">Confirm Password</label>
                    <input
                        type="text"
                        class="input"
                        name="password_confirmation"
                        v-model="form.password_confirmation"
                    />
                    <InputError
                        v-show="form.errors.password_confirmation"
                        :error="form.errors.password_confirmation"
                    />
                </div>
                <div class="mt-4 mb-2">
                    <button
                        class="btn-primary w-full text-center"
                        :disabled="form.processing"
                        type="submit"
                    >
                        Register
                    </button>
                </div>
                <div class="mt-2 text-gray-800 text-sm text-center">
                    Already have an account?
                    <Link :href="route('login')"> Click here</Link>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const register = () => form.post(route("user-account.store"));
</script>

<style lang="scss" scoped></style>
