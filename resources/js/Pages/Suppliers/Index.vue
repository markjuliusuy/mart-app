<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Suppliers
            </h2>
        </template>

        <teleport to="head">
            <title>Suppliers</title>
        </teleport>

        <div>
            <h1 class="mb-8 font-bold text-3xl">Suppliers</h1>
            <div class="mb-6 flex justify-between items-center">
                <inertia-link :href="route('suppliers.create')" class="btn-indigo">
                    <span>Create</span> <span class="hidden md:inline">Supplier</span>
                </inertia-link>
            </div>

            <div>
                <div>
                    <vue-good-table
                        :columns="columns"
                        :rows="suppliers"
                        :pagination-options="{
                        enabled: true,
                      }"
                        :search-options="{
                            enabled: true,
                          }"
                    >
                        <template v-slot:table-row="props">
                            <span v-if="props.column.field == 'actions'">
                                <inertia-link :href="route('suppliers.edit', props.row.id)" class="text-sm text-gray-700 underline">Edit</inertia-link><button  @click="destroy(props.row.id)" class="text-sm underline ml-1" v-if="props.row.permissions.delete" >Delete</button>
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
        suppliers: Object,
    },
    data(){
        return {
            columns: [
                {
                    label: 'Company Name',
                    field: 'company_name',
                },
                {
                    label: 'Name',
                    field: 'name',
                },
                {
                    label: 'Email',
                    field: 'email',
                },
                {
                    label: 'Contact Number',
                    field: 'contact_number',
                },
                {
                    label: 'Created On',
                    field: 'created_at'
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
                this.$inertia.delete(this.route('suppliers.destroy', id))
            }
        },
    }
}
</script>
