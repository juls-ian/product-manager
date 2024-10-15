<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import ProductForm from "./Partials/ProductForm.vue";

defineProps({
    categories: {
        type: Array,
        required: true,
    },
});
// form
const form = useForm({
    name: "",
    brand: "",
    category_id: "",
    price: null,
    weight: null,
    desc: "",
});

// saving data
const saveProduct = () => {
    form.post(route("products.store"), {
        onSuccess: () => form.reset(), //reset inputs
    });
};
</script>

<template>
    <Head title="New Product" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                >
                    New Product
                </h2>
                <Link
                    :href="route('products.index')"
                    class="px-3 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                >
                    Manage products</Link
                >
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="flex items-center justify-center">
                        <div class="relative w-full max-w-2xl max-h-full">
                            <ProductForm
                                :form="form"
                                :categories="categories"
                                @submit="saveProduct"
                            >
                                <template v-slot:commands>
                                    <button
                                        type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                    >
                                        Save
                                    </button>
                                    <Link
                                        :href="route('products.index')"
                                        type="button"
                                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5"
                                    >
                                        Cancel
                                    </Link>
                                </template>
                            </ProductForm>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
