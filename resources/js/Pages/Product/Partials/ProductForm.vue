<script setup>
defineProps({
    form: {
        type: Object,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
});

const emit = defineEmits(["submit"]);
</script>

<template>
    <form
        @submit.prevent="emit('submit')"
        class="relative bg-white rounded-lg shadow"
    >
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-6 gap-6">
                <!-- PRODUCT NAME -->
                <div class="col-span-6 sm:col-span-6">
                    <label
                        for="name"
                        class="block mb-2 text-sm font-medium"
                        :class="{
                            'text-gray-900': !form.errors.name,
                            'text-red-700': form.errors.name,
                        }"
                        >Product name</label
                    >
                    <input
                        type="text"
                        name="name"
                        v-model="form.name"
                        id="name"
                        class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                        :class="{
                            'bg-red-50 border border-red-500 text-red-900':
                                form.errors.name,
                            'bg-gray-50 border-gray-300 text-gray-900':
                                !form.errors.name,
                        }"
                    />
                    <div
                        class="font-sm text-red-500 mt-2"
                        v-if="form.errors.name"
                    >
                        {{ form.errors.name }}
                    </div>
                </div>
                <!-- BRAND -->
                <div class="col-span-6 sm:col-span-3">
                    <label
                        for="brand"
                        class="block mb-2 text-sm font-medium"
                        :class="{
                            'text-gray-900': !form.errors.brand,
                            'text-red-700': form.errors.brand,
                        }"
                        >Brand</label
                    >
                    <input
                        type="text"
                        name="brand"
                        v-model="form.brand"
                        id="brand"
                        class="shadow-sm text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                        :class="{
                            'bg-red-50 border border-red-500 text-red-900':
                                form.errors.name,
                            'bg-gray-50 border-gray-300 text-gray-900':
                                !form.errors.name,
                        }"
                    />
                    <div
                        class="font-sm text-red-500 mt-2"
                        v-if="form.errors.brand"
                    >
                        {{ form.errors.brand }}
                    </div>
                </div>
                <!-- CATEGORY -->
                <div class="col-span-6 sm:col-span-3">
                    <label
                        for="category_id"
                        class="block mb-2 text-sm font-medium"
                        :class="{
                            'text-gray-900': !form.errors.category_id,
                            'text-red-700': form.errors.category_id,
                        }"
                        >Category</label
                    >
                    <select
                        name="category_id"
                        v-model="form.category_id"
                        id="category_id"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                    >
                        <option value="">Select category</option>
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                            :class="{
                                'bg-red-50 border border-red-500 text-red-900':
                                    form.errors.category_id,
                                'bg-gray-50 border-gray-300 text-gray-900':
                                    !form.errors.category_id,
                            }"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                    <div
                        class="font-sm text-red-500 mt-2"
                        v-if="form.errors.category_id"
                    >
                        {{ form.errors.category_id }}
                    </div>
                </div>
                <!-- PRICE -->
                <div class="col-span-6 sm:col-span-3">
                    <label
                        for="price"
                        class="block mb-2 text-sm font-medium"
                        :class="{
                            'text-gray-900': !form.errors.price,
                            'text-red-700': form.errors.price,
                        }"
                        >Price</label
                    >
                    <input
                        type="number"
                        name="price"
                        v-model="form.price"
                        id="price"
                        class="shadow-sm text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                        :class="{
                            'bg-red-50 border border-red-500 text-red-900':
                                form.errors.price,
                            'bg-gray-50 border-gray-300 text-gray-900':
                                !form.errors.price,
                        }"
                    />
                    <div
                        class="font-sm text-red-500 mt-2"
                        v-if="form.errors.price"
                    >
                        {{ form.errors.price }}
                    </div>
                </div>
                <!-- WEIGHT -->
                <div class="col-span-6 sm:col-span-3">
                    <label
                        for="weight"
                        class="block mb-2 text-sm font-medium"
                        :class="{
                            'text-gray-900': !form.errors.weight,
                            'text-red-700': form.errors.weight,
                        }"
                        >Weight</label
                    >
                    <input
                        type="number"
                        name="weight"
                        v-model="form.weight"
                        id="weight"
                        class="shadow-sm text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                        :class="{
                            'bg-red-50 border border-red-500 text-red-900':
                                form.errors.weight,
                            'bg-gray-50 border-gray-300 text-gray-900':
                                !form.errors.weight,
                        }"
                    />
                    <div
                        class="font-sm text-red-500 mt-2"
                        v-if="form.errors.price"
                    >
                        {{ form.errors.weight }}
                    </div>
                </div>
                <!-- DESCRIPTION -->
                <div class="col-span-6 sm:col-span-6">
                    <label
                        for="description"
                        class="block mb-2 text-sm font-medium"
                        :class="{
                            'text-gray-900': !form.errors.desc,
                            'text-red-700': form.errors.desc,
                        }"
                        >Description</label
                    >
                    <textarea
                        name="description"
                        v-model="form.desc"
                        id="description"
                        class="shadow-sm text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                        rows="3"
                        :class="{
                            'bg-red-50 border border-red-500 text-red-900':
                                form.errors.desc,
                            'bg-gray-50 border-gray-300 text-gray-900':
                                !form.errors.desc,
                        }"
                    ></textarea>
                    <div
                        class="font-sm text-red-500 mt-2"
                        v-if="form.errors.desc"
                    >
                        {{ form.errors.desc }}
                    </div>
                </div>
                <!-- BUTTONS -->
                <div class="col-span-6 sm:col-span-6 space-x-2">
                    <slot name="commands" />
                </div>
            </div>
        </div>
    </form>
</template>
