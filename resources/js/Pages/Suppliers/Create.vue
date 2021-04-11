<template>
    <div>

        <teleport to="head">
            <title>Create Supplier</title>
        </teleport>
<!--        <div class="mb-8 flex items-center justify-between bg-red-400 rounded max-w-3xl">-->
<!--            <div class="flex items-center">-->
<!--                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"-->
<!--                     class="ml-4 mr-2 flex-shrink-0 w-4 h-4 fill-white">-->
<!--                    <path-->
<!--                        d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34 8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83-1.41 1.41L10 11.41l-2.83 2.83-1.41-1.41L8.59 10 5.76 7.17l1.41-1.41L10 8.59l2.83-2.83 1.41 1.41z"></path>-->
<!--                </svg>-->
<!--                <div class="py-4 text-white text-sm font-medium"><span>Whoops! Something went wrong.</span></div>-->
<!--            </div>-->
<!--            <button type="button" class="group mr-2 p-2">-->
<!--                <svg xmlns="http://www.w3.org/2000/svg" width="235.908" height="235.908"-->
<!--                     viewBox="278.046 126.846 235.908 235.908"-->
<!--                     class="block w-2 h-2 fill-red-800 group-hover:fill-white">-->
<!--                    <path-->
<!--                        d="M506.784 134.017c-9.56-9.56-25.06-9.56-34.62 0L396 210.18l-76.164-76.164c-9.56-9.56-25.06-9.56-34.62 0-9.56 9.56-9.56 25.06 0 34.62L361.38 244.8l-76.164 76.165c-9.56 9.56-9.56 25.06 0 34.62 9.56 9.56 25.06 9.56 34.62 0L396 279.42l76.164 76.165c9.56 9.56 25.06 9.56 34.62 0 9.56-9.56 9.56-25.06 0-34.62L430.62 244.8l76.164-76.163c9.56-9.56 9.56-25.06 0-34.62z"></path>-->
<!--                </svg>-->
<!--            </button>-->
<!--        </div>-->
        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('suppliers.index')">Suppliers
            </inertia-link>
            <span class="text-indigo-400 font-medium">/</span> Create
        </h1>
        <div class="mt-5 md:mt-0 md:col-span-2 max-w-3xl">
            <form @submit.prevent="store">
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="company_name" value="Company Name"/>
                        <jet-input id="company_name" type="text" class="mt-1 block w-full" v-model="form.company_name" :error="form.errors.company_name"/>
                        <jet-input-error :message="form.errors.company_name" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="name" value="Name"/>
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" :error="form.errors.name"/>
                        <jet-input-error :message="form.errors.name" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="contact_person" value="Contact Person"/>
                        <jet-input id="contact_person" type="text" class="mt-1 block w-full" v-model="form.contact_person" :error="form.errors.contact_person"/>
                        <jet-input-error :message="form.errors.contact_person" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="contact_number" value="Contact Number"/>
                        <jet-input id="contact_number" type="text" class="mt-1 block w-full"
                                   v-model="form.contact_number" :error="form.errors.contact_number"/>
                        <jet-input-error :message="form.errors.contact_number" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="email" value="Email"/>
                        <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" :error="form.errors.email"/>
                        <jet-input-error :message="form.errors.email" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-6">
                        <jet-label for="address" value="Address"/>
                        <jet-input id="address" type="text" class="mt-1 block w-full" v-model="form.address" :error="form.errors.address"/>
                        <jet-input-error :message="form.errors.address" class="mt-2"/>
                    </div>
                </div>
                <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                    <button :disabled="form.processing" class="flex items-center btn-indigo" type="submit">
                        <div v-if="form.processing" class="btn-spinner mr-2"/>
                        Create Supplier
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },
    layout: AppLayout,
    remember: 'form',
    data() {
        return {
            form: this.$inertia.form({
                company_name: null,
                name: null,
                contact_person: null,
                contact_number: null,
                email: null,
                address: null
            }),
        }
    },
    methods: {
        store() {
            this.form.post(this.route('suppliers.store'))
        },
    },
}
</script>
