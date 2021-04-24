<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>

        <teleport to="head">
            <title>Categories</title>
        </teleport>

        <div>
            <h1 class="mb-8 font-bold text-3xl">Categories</h1>
            <div class="mb-6 flex justify-between items-center">
                <inertia-link :href="route('categories.create')" class="btn-indigo">
                    <span>Create</span> <span class="hidden md:inline">Category</span>
                </inertia-link>
            </div>

            <div>
                <div>
                    <vue-good-table
                        :columns="columns"
                        :rows="categories"
                        :pagination-options="{
                        enabled: true,
                      }"
                        :search-options="{
                            enabled: true,
                          }"
                    >
                        <template v-slot:table-row="props">
                            <div v-if="props.column.field == 'actions'">
                                <inertia-link :href="route('categories.edit', props.row.id)" class="text-sm text-gray-700 underline">Edit</inertia-link>
                                <button  @click="destroy(props.row.id)" class="text-sm underline ml-1" v-if="props.row.permissions.delete" >Delete</button>
                            </div>
                            <div v-else>
                                {{ props.formattedRow[props.column.field] }}
                             </div>
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
        categories: Object,
    },
    data(){
        return {
            columns: [
                {
                    label: 'Name',
                    field: 'name',
                },
                {
                    label: 'Description',
                    field: 'description',
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
                this.$inertia.delete(this.route('categories.destroy', id))
            }
        },
    }
}
</script>
