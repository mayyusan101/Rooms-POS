<template>
    <div class="bg-white text-gray-900 container mx-auto mt-4">
        <Box>
            <template #header>Upload New image</template>
            <form @submit.prevent="upload">
                <section
                    class="my-2 flex flex-col md:flex-row md:items-center gap-4 md:gap-2"
                >
                    <input
                        type="file"
                        @input="addFile"
                        id="images"
                        multiple
                        class="bg-white file:px-4 file:py-2 rounded-md file:border-none border-gray-300 border file:mr-4 file:text-gray-600 text-gray-600 font-medium file:bg-gray-200 file:active:border-gray-200 file:cursor-pointer file:focus:border-gray-200"
                    />

                    <button
                        class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed"
                        :disabled="!canUpload"
                    >
                        Upload
                    </button>
                    <button class="btn-outline" type="reset" @click="reset">
                        Reset
                    </button>
                </section>
                <div v-if="inputError.length">
                    <div
                        v-for="(error, index) in inputError"
                        :key="index"
                        class="input-error"
                    >
                        <InputError :error="error" />
                    </div>
                </div>
            </form>
        </Box>

        <Box class="mt-6" v-if="props.listing.images.length">
            <template #header>Current Listing Image</template>
            <section
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mt-2"
            >
                <div v-for="image in props.listing.images" :key="image.id">
                    <img :src="image.src" alt="" class="rounded-md" />
                    <Link
                        :href="
                            route('realtor.listing.image.destroy', {
                                listing: props.listing.id,
                                image: image.id,
                            })
                        "
                        as="button"
                        method="delete"
                        class="btn-outline w-full mt-4 rounded"
                        >Delete</Link
                    >
                </div>
            </section>
        </Box>
        <EmptyState v-else class="mt-6">No Listing Images</EmptyState>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import Box from "@/Components/UI/Box.vue";
import { computed } from "vue";
import NProgress from "nprogress";
import { Link } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import EmptyState from "@/Components/UI/EmptyState.vue";

const props = defineProps({ listing: Object, csrf_token: String });

const form = useForm({
    images: [],
    csrf_token: props.csrf_token,
});

const upload = () => {
    form.post(
        route("realtor.listing.image.store", { listing: props.listing.id }),
        {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => form.reset("images"),
        }
    );
};

const addFile = (event) => {
    for (const file of event.target.files) {
        form.images.push(file);
    }
};

const canUpload = computed(() => form.images.length);

const reset = () => form.reset("images");

// progress bar
router.on("progress", (event) => {
    if (event.detail.progress.percentage) {
        NProgress.set((event.detail.progress.percentage / 100) * 0.9);
    }
});

const inputError = computed(() => Object.values(form.errors));
</script>

<style lang="scss" scoped></style>
