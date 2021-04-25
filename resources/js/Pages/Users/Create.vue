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
                        <jet-label for="first_name" value="Name"/>
                        <jet-input id="first_name" type="text" class="mt-1 block w-full" v-model="form.name" :error="form.errors.name"/>
                        <jet-input-error :message="form.errors.name" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="username" value="Username"/>
                        <jet-input id="username" type="text" class="mt-1 block w-full" v-model="form.username" :error="form.errors.username"/>
                        <jet-input-error :message="form.errors.username" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="email" value="Email"/>
                        <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" :error="form.errors.email"/>
                        <jet-input-error :message="form.errors.email" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="user_role" value="Role"/>
                        <select name="user_role" id="user_role_id" v-model="form.user_role" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option v-for="role in roles" :value="role.name">{{ role.name }}</option>
                        </select>
                        <jet-input-error :message="form.errors.user_role" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="password" value="Password"/>
                        <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" :error="form.errors.password"/>
                        <jet-input-error :message="form.errors.password" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="password_confirmation" value="Confirm Password" />
                        <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" :error="form.errors.password_confirmation"/>
                        <jet-input-error :message="form.errors.password_confirmation" class="mt-2"/>
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
      roles: Object
    },
    data() {
        return {
            page_title: 'User',
            page_title_plural: 'Users',
            page_action: 'Update',
            page_action_title: 'Create User',
            submit_action_label: 'Create User',
            route_index: 'users.index',
            route_create: 'users.create',
            route_edit: 'users.edit',
            route_store: 'users.store',
            form: this.$inertia.form({
                name: null,
                username: null,
                email: null,
                user_role: 'admin',
                password_confirmation: null,
                password: null,
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
