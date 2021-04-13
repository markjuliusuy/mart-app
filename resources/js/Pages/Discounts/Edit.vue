<template>
    <div>

        <teleport to="head">
            <title>{{ page_action_title }}</title>
        </teleport>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route(route_index)">{{ page_title_plural }}</inertia-link> <span class="text-indigo-400 font-medium">/</span>
            {{ page_action }}
        </h1>
        <div class="mt-5 md:mt-0 md:col-span-2 max-w-3xl">
            <form @submit.prevent="update">
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="name" value="Name"/>
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" :error="form.errors.name"/>
                        <jet-input-error :message="form.errors.name" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="value" value="Value"/>
                        <jet-input id="value" type="text" class="mt-1 block w-full" v-model="form.value" :error="form.errors.value"/>
                        <jet-input-error :message="form.errors.value" class="mt-2"/>
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
      discount: Object
    },
    data() {
        return {
            page_title: 'Discount',
            page_title_plural: 'Discounts',
            page_action: 'Update',
            page_action_title: 'Update Discount',
            submit_action_label: 'Update Discount',
            route_index: 'discounts.index',
            route_create: 'discounts.create',
            route_edit: 'discounts.edit',
            route_store: 'discounts.store',
            route_update: 'discounts.update',

            form: this.$inertia.form({
                name: this.discount.name,
                value: this.discount.value
            }),
        }

    },
    methods: {
        update() {
            this.form.put(this.route(this.route_update, this.discount.id))
        },
    },
}
</script>
