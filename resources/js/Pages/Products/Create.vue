<template>
    <div>

        <teleport to="head">
            <title>{{ page_action_title }}</title>
        </teleport>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route(route_index)">{{ page_title_plural }}</inertia-link> <span class="text-indigo-400 font-medium">/</span> Create
        </h1>
        <div class="mt-5 md:mt-0 md:col-span-2 max-w-3xl">
            <form @submit.prevent="store">
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
                            <option value="">Select brand</option>
                            <option v-for="brand in brands" :value="brand.id">{{ brand.name }}</option>
                        </select>
                        <jet-input-error :message="form.errors.brand_id" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="category_id" value="Category"/>
                        <select name="category_id" id="category_id" v-model="form.category_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select category</option>
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


            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" :class="{ 'hidden': !showModal }">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <!--
                      Background overlay, show/hide based on modal state.

                      Entering: "ease-out duration-300"
                        From: "opacity-0"
                        To: "opacity-100"
                      Leaving: "ease-in duration-200"
                        From: "opacity-100"
                        To: "opacity-0"
                    -->
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                    <!-- This element is to trick the browser into centering the modal contents. -->
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <!--
                      Modal panel, show/hide based on modal state.

                      Entering: "ease-out duration-300"
                        From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        To: "opacity-100 translate-y-0 sm:scale-100"
                      Leaving: "ease-in duration-200"
                        From: "opacity-100 translate-y-0 sm:scale-100"
                        To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    -->
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="w-full">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                        Add Brand
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                        <div class="col-span-6 sm:col-span-4 pb-6">
                                            <jet-label for="brand_name" value="Name"/>
                                            <jet-input id="brand_name" type="text" class="mt-1 block w-full" v-model="brand_form.name" :error="brand_form.errors.name"/>
                                            <jet-input-error :message="brand_form.errors.code" class="mt-2"/>
                                        </div>
                                        <div class="pb-6">
                                            <jet-label for="brand_description" value="Description"/>
                                            <jet-input id="brand_description" type="text" class="mt-1 block w-full" v-model="brand_form.description" :error="brand_form.errors.description"/>
                                            <jet-input-error :message="brand_form.errors.description" class="mt-2"/>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo500 sm:ml-3 sm:w-auto sm:text-sm">
                                Save
                            </button>
                            <button @click="showModal = !showModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
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
      brands: Object,
      categories: Object
    },
    data() {
        return {
            page_title: 'Product',
            page_title_plural: 'Products',
            page_action: 'Update',
            page_action_title: 'Create Product',
            submit_action_label: 'Create Product',
            route_index: 'products.index',
            route_create: 'products.create',
            route_edit: 'products.edit',
            route_store: 'products.store',
            showModal: false,
            form: this.$inertia.form({
                name: null,
                code: null,
                description: null,
                brand_id: null,
                category_id: null,
                price: null,
                reorder_level: null,
            }),
            brand_form: this.$inertia.form({
                name: null,
                description: null,
            }),
        }

    },
    methods: {
        store() {
            this.form.post(this.route(this.route_store))
        },
        openModal() {
            this.showModal = !this.showModal;
        }
    },
}
</script>
