<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ page_title_plural }}
            </h2>
        </template>

        <teleport to="head">
            <title>{{ page_title_plural }}</title>
        </teleport>

        <div>
            <h1 class="mb-8 font-bold text-3xl">{{ page_title_plural }}</h1>
            <div class="mb-6 flex justify-between items-center">
                <inertia-link :href="route(route_create)" class="btn-indigo">
                    <span>Create</span> <span class="hidden md:inline">{{ page_title }}</span>
                </inertia-link>
            </div>

            <div>
                <div>
                    <vue-good-table
                        :columns="columns"
                        :rows="products"
                        :pagination-options="{
                        enabled: true,
                      }"
                        :search-options="{
                            enabled: true,
                          }"
                    >
                        <template v-slot:table-row="props">
                            <span v-if="props.column.field == 'actions'">
                                <inertia-link :href="route(route_edit, props.row.id)" class="text-sm text-gray-700 underline">
                                    Edit
                                </inertia-link>
                            </span>
                            <span v-else>
                                {{ props.formattedRow[props.column.field] }}
                             </span>
                        </template>
                    </vue-good-table>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import 'vue-good-table/dist/vue-good-table.css'
import VueGoodTable from '@/Shared/vue3-good-table/Table'

export default {
    components: {
        AppLayout,
        VueGoodTable
    },
    props: {
        products: Object,
    },
    data(){
        return {
            page_title: 'Product',
            page_title_plural: 'Products',
            page_title_action: 'Create Product',
            route_create: 'products.create',
            route_edit: 'products.edit',
            columns: [
                {
                    label: 'Name',
                    field: 'name',
                },
                {
                    label: 'Code',
                    field: 'code',
                },
                {
                    label: 'Price',
                    field: 'price',
                },
                {
                    label: 'Reorder Level',
                    field: 'reorder_level',
                },
                {
                    label: 'Actions',
                    field: 'actions'
                }
            ]
        };
    }
}
</script>
