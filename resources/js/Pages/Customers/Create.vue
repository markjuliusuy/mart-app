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
                        <jet-label for="first_name" value="First Name"/>
                        <jet-input id="first_name" type="text" class="mt-1 block w-full" v-model="form.first_name" :error="form.errors.first_name"/>
                        <jet-input-error :message="form.errors.first_name" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="last_name" value="Last Name"/>
                        <jet-input id="last_name" type="text" class="mt-1 block w-full" v-model="form.last_name" :error="form.errors.last_name"/>
                        <jet-input-error :message="form.errors.last_name" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="contact_number" value="Contact Number"/>
                        <jet-input id="contact_number" type="text" class="mt-1 block w-full" v-model="form.contact_number" :error="form.errors.contact_number"/>
                        <jet-input-error :message="form.errors.contact_number" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="address" value="Address"/>
                        <jet-input id="address" type="text" class="mt-1 block w-full" v-model="form.address" :error="form.errors.address"/>
                        <jet-input-error :message="form.errors.address" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="date_of_birth" value="Date of birth"/>
                        <input type="date" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" :class="{ 'border-red-500': form.errors.date_of_birth }" v-model="form.date_of_birth">
                        <jet-input-error :message="form.errors.date_of_birth" class="mt-2"/>
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
    data() {
        return {
            page_title: 'Customer',
            page_title_plural: 'Customers',
            page_action: 'Update',
            page_action_title: 'Create Customer',
            submit_action_label: 'Create Customer',
            route_index: 'customers.index',
            route_create: 'customers.create',
            route_edit: 'customers.edit',
            route_store: 'customers.store',
            form: this.$inertia.form({
                first_name: null,
                last_name: null,
                contact_number: null,
                address: null,
                date_of_birth: null,
            }),
        }

    },
    methods: {
        store() {
            this.form.post(this.route(this.route_store))
        },
    },
}
</script>
