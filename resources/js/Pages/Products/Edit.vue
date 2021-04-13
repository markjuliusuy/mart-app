<template>
    <div>

        <teleport to="head">
            <title>{{ page_action_title }}</title>
        </teleport>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route(route_index)">{{ page_title_plural }}</inertia-link> <span class="text-indigo-400 font-medium">/</span> Update
        </h1>
        <div class="mt-5 md:mt-0 md:col-span-2 max-w-3xl">
            <form @submit.prevent="update">
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="code" value="Code"/>
                        <jet-input id="code" type="text" class="mt-1 block w-full" v-model="form.code" :error="form.errors.code"/>
                        <jet-input-error :message="form.errors.code" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="name" value="Name"/>
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" :error="form.errors.name"/>
                        <jet-input-error :message="form.errors.name" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="price" value="Price"/>
                        <jet-input id="price" type="text" class="mt-1 block w-full" v-model="form.price" :error="form.errors.price"/>
                        <jet-input-error :message="form.errors.price" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="reorder_level" value="Reorder Level"/>
                        <jet-input id="reorder_level" type="number" class="mt-1 block w-full" v-model="form.reorder_level" :error="form.errors.reorder_level"/>
                        <jet-input-error :message="form.errors.reorder_level" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <div class="flex justify-between">
                            <label class="block font-medium text-sm text-gray-700" for="brand_id">
                                Brand
                            </label>
                            <!--                           <button type="button" class="btn btn-sm btn-link" @click="openModal('brand')">-->
                            <!--                              + Add</button>-->
                        </div>
                        <select name="brand_id" id="brand_id" v-model="form.brand_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option v-for="brand in brands" :value="brand.id">{{ brand.name }}</option>
                        </select>
                        <jet-input-error :message="form.errors.brand_id" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="category_id" value="Category"/>
                        <select name="category_id" id="category_id" v-model="form.category_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                        </select>
                        <jet-input-error :message="form.errors.category_id" class="mt-2"/>
                    </div>

                </div>
                <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                    <button :disabled="form.processing" class="flex items-center btn-indigo" type="submit">
                        <div v-if="form.processing" class="btn-spinner mr-2"/>
                        {{ submit_action_label }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

export default {
    components: {
        JetInput,
        JetInputError,
        JetLabel,
    },
    layout: AppLayout,
    remember: 'form',
    props: {
        product: Object,
        brands: Object,
        categories: Object
    },
    data() {
        return {
            page_title: 'Product',
            page_title_plural: 'Products',
            page_action: 'Update',
            page_action_title: 'Update Product',
            submit_action_label: 'Update Product',
            route_index: 'products.index',
            route_update: 'products.update',
            showModal: false,
            form: this.$inertia.form({
                name: this.product.name,
                code: this.product.code,
                description: this.product.description,
                brand_id: this.product.brand_id,
                category_id: this.product.category_id,
                price: this.product.price,
                reorder_level: this.product.reorder_level,
            })
        }

    },
    methods: {
        update() {
            this.form.put(this.route(this.route_update, this.product.id))
        },
        openModal() {
            this.showModal = !this.showModal;
        }
    },
}
</script>
