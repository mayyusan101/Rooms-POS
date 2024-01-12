<template>
    <div class="container mx-auto py-4">
        <form @submit.prevent="create">
            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-2">
                    <label class="label" for="beds">Beds</label>
                    <input
                        type="text"
                        name="beds"
                        placeholder="beds.."
                        class="input"
                        v-model="form.beds"
                    />
                    <InputError
                        v-show="form.errors.beds"
                        :error="form.errors.beds"
                    />
                </div>
                <div class="col-span-2">
                    <label class="label" for="baths">Baths</label>
                    <input
                        type="text"
                        name="baths"
                        placeholder="baths.."
                        class="input"
                        v-model="form.baths"
                    />
                    <InputError
                        v-show="form.errors.baths"
                        :error="form.errors.baths"
                    />
                </div>
                <div class="col-span-2">
                    <label class="label" for="area">Area</label>
                    <input
                        type="text"
                        name="area"
                        placeholder="area.."
                        class="input"
                        v-model="form.area"
                    />
                    <InputError
                        v-show="form.errors.area"
                        :error="form.errors.area"
                    />
                </div>
                <div class="col-span-4">
                    <label class="label" for="city">City</label>
                    <input
                        type="text"
                        name="city"
                        placeholder="city.."
                        class="input"
                        v-model="form.city"
                    />
                    <InputError
                        v-show="form.errors.city"
                        :error="form.errors.city"
                    />
                </div>
                <div class="col-span-2">
                    <label class="label" for="street">Street</label>
                    <input
                        type="text"
                        name="street"
                        placeholder="street.."
                        class="input"
                        v-model="form.street"
                    />
                    <InputError
                        v-show="form.errors.street"
                        :error="form.errors.street"
                    />
                </div>
                <div class="col-span-4">
                    <label class="label" for="code">Code</label>
                    <input
                        type="text"
                        name="code"
                        placeholder="code.."
                        class="input"
                        v-model="form.code"
                    />
                    <InputError
                        v-show="form.errors.code"
                        :error="form.errors.code"
                    />
                </div>
                <div class="col-span-2">
                    <label class="label" for="street_no">Street-No</label>
                    <input
                        type="text"
                        name="street_no"
                        placeholder="street_no.."
                        class="input"
                        v-model="form.street_no"
                    />
                    <InputError
                        v-show="form.errors.street_no"
                        :error="form.errors.street_no"
                    />
                </div>
                <div class="col-span-6">
                    <label class="label" for="price">Price</label>
                    <input
                        type="text"
                        name="price"
                        placeholder="price.."
                        class="input"
                        v-model="form.price"
                    />
                    <InputError
                        v-show="form.errors.price"
                        :error="form.errors.price"
                    />
                </div>
            </div>
            <button type="submit" class="btn-primary mt-4">Create</button>
        </form>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3"; // useForm = { router.post('/store') } + reactive()
import InputError from "@/Components/InputError.vue";
const form = useForm({
    beds: 0,
    baths: 0,
    area: 0,
    city: "",
    street: "",
    code: "",
    street_no: "",
    price: 0,
});

const create = () => form.post(route("realtor.listing.store"));
</script>

<style lang="scss" scoped></style>
