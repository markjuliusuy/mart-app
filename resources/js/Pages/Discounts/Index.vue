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
                        :rows="discounts"
                        :pagination-options="{
                        enabled: true,
                      }"
                        :search-options="{
                            enabled: true,
                          }"
                    >
                        <template v-slot:table-row="props">
                            <span v-if="props.column.field == 'actions'">
                                <inertia-link :href="route(route_edit, props.row.id)" class="text-sm text-gray-700 underline">Edit</inertia-link>
                                <button  @click="destroy(props.row.id)" class="text-sm underline ml-1" v-if="props.row.permissions.delete" >Delete</button>

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
        discounts: Object,
    },
    data(){
        return {
            page_title: 'Discount',
            page_title_plural: 'Discounts',
            page_title_action: 'Create Discount',
            route_create: 'discounts.create',
            route_edit: 'discounts.edit',
            columns: [
                {
                    label: 'Name',
                    field: 'name',
                },
                {
                    label: 'Value',
                    field: 'value',
                },
                {
                    label: 'Actions',
                    field: 'actions'
                }
            ]
        };
    },
    methods: {
        destroy(id) {
            if (confirm('Are you sure you want to delete?')) {
                this.$inertia.delete(this.route('discounts.destroy', id))
            }
        },
    }
}
</script>
