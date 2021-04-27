<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Settings
            </h2>
        </template>

        <teleport to="head">
            <title>Settings</title>
        </teleport>

        <div>
            <h1 class="mb-8 font-bold text-3xl">Settings</h1>

            <div>
                <div>
                    <vue-good-table
                        :columns="columns"
                        :rows="settings"
                        :pagination-options="{
                        enabled: true,
                      }"
                        :search-options="{
                            enabled: true,
                          }"
                    >
                        <template v-slot:table-row="props">
                            <span v-if="props.column.field == 'actions'">
                                <inertia-link :href="route('settings.edit', props.row.id)" class="text-sm text-gray-700 underline">Edit</inertia-link>
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
        settings: Object,
    },
    data(){
        return {
            columns: [
                {
                    label: 'Name',
                    field: 'name',
                },
                {
                    label: 'Value',
                    field: 'payload',
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
                this.$inertia.delete(this.route('settings.destroy', id))
            }
        },
    }
}
</script>
