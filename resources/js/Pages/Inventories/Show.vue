<template>
    <div>

        <teleport to="head">
            <title>{{ page_action_title }}</title>
        </teleport>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route(route_index)">{{
                    page_title_plural
                }}
            </inertia-link>
            <span class="text-indigo-400 font-medium">/</span> Create
        </h1>
        <div class="mt-5 md:mt-0 md:col-span-2 max-w-4xl">
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md grid grid-cols-6 gap-6">
                <div class="col-span-12 sm:col-span-12 pb-2">
                    {{ inventory.supplier_name }}
                </div>

            </div>
            <h2 class="mt-12 font-bold text-2xl">Selected Products</h2>
            <div class="mt-6 bg-white rounded shadow overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <tr class="text-left font-bold">
                        <th class="px-6 pt-6 pb-4">Product</th>
                        <th class="px-6 pt-6 pb-4">Quantity</th>
                        <th class="px-6 pt-6 pb-4" colspan="2">Price</th>
                        <th class="px-6 pt-6 pb-4" colspan="2">Amount</th>
                    </tr>
                    <tr v-for="(selected_product, index) in inventory.products" :key="selected_product.id"
                        class="hover:bg-gray-100 focus-within:bg-gray-100 text-right">
                        <td class="border-t text-left">
                            <div class="px-6 pt-6 pb-4">
                                {{ selected_product.product_name }}
                            </div>
                        </td>
                        <td class="border-t">
                            <div class="px-6 pt-6 pb-4">
                            {{ selected_product.quantity }}
                            </div>
                        </td>
                        <td class="border-t" colspan="2">
                            <div class="px-6 pt-6 pb-4">
                                {{ selected_product.price }}
                             </div>
                        </td>
                        <td class="border-t" colspan="2">
                            <div class="px-6 pt-6 pb-4">
                                {{
                                    (selected_product.quantity * selected_product.price).toLocaleString(
                                        undefined, // leave undefined to use the visitor's browser
                                        // locale or a string like 'en-US' to override it.
                                        {minimumFractionDigits: 2}
                                    )
                                }}
                            </div>
                        </td>
                    </tr>
                    <tr class="border-t text-right font-bold">
                        <th class="px-6 pt-6 pb-4" colspan="4">Total</th>
                        <th class="px-6 pt-6 pb-4" colspan="2">{{ parseFloat(inventory.total_amount).toLocaleString(undefined, {minimumFractionDigits: 2}) }}</th>
                    </tr>
                </table>
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
    props: {
        inventory: Object,
    },
    data() {
        return {
            page_title: 'Inventory',
            page_title_plural: 'Inventories',
            page_action: 'Update',
            page_action_title: 'Create Inventory',
            submit_action_label: 'Save',
            route_index: 'inventories.index',
            route_create: 'inventories.create',
            route_edit: 'inventories.edit',
            route_store: 'inventories.store',
        }

    },
    methods: {},
}
</script>
