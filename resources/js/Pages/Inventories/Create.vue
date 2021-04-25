<template>
    <div>

        <teleport to="head">
            <title>{{ page_action_title }}</title>
        </teleport>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route(route_index)">{{ page_title_plural }}</inertia-link> <span class="text-indigo-400 font-medium">/</span> Create
        </h1>
        <div class="mt-5 md:mt-0 md:col-span-2 max-w-4xl">
            <form @submit.prevent="store">
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md grid grid-cols-6 gap-6">
                    <div class="col-span-12 sm:col-span-12 pb-2">
                        <div class="flex justify-between">
                            <label class="block font-medium text-sm text-gray-700" for="supplier_id">
                                Supplier
                            </label>
                            <!--                           <button type="button" class="btn btn-sm btn-link" @click="openModal('brand')">-->
                            <!--                              + Add</button>-->
                        </div>
                        <select name="supplier_id" id="supplier_id" v-model="form.supplier_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option v-for="supplier in suppliers" :value="supplier.id">{{ supplier.contact_person }}</option>
                        </select>
                        <jet-input-error :message="form.errors.supplier_id" class="mt-2"/>
                    </div>
                    <div class="col-span-12 sm:col-span-12 border border-gray-300 "></div>
                    <div class="col-span-4 sm:col-span-4 lg:col-span-3">
                        <div class="flex justify-between">
                            <label class="block font-medium text-sm text-gray-700" for="product_id">
                                Product
                            </label>
                            <!--                           <button type="button" class="btn btn-sm btn-link" @click="openModal('brand')">-->
                            <!--                              + Add</button>-->
                        </div>
                        <select name="product_id" id="product_id" v-model="product_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option v-for="product in products" :value="product.id">{{ product.name }}</option>
                        </select>
                        <jet-input-error :message="form.errors.product_id" class="mt-2"/>
                    </div>
                    <div class="col-span-4 sm:col-span-4 lg:col-span-3">
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="text" name="quantity" id="quantity" v-model="quantity" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="col-span-4 sm:col-span-4 lg:col-span-3">
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="text" name="price" id="price" v-model="price" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="col-span-12 grid justify-items-end">
                        <button class="flex items-end btn-indigo" type="button" @click="addToSelectedProducts">
                            Add to list
                        </button>
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
                            <th class="px-6 pt-6 pb-4"></th>
                        </tr>
                        <tr v-for="(selected_product, index) in form.selected_products" :key="selected_product.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                            <td class="border-t">
                                <div class="px-6 pt-6 pb-4">
                                    {{ selected_product.name }}
                                </div>
                            </td>
                            <td class="border-t" colspan="2">
                                <div class="px-6 pt-6 pb-4">
                                    <input type="text" v-model="selected_product.price" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </td>
                            <td class="border-t">
                                <div class="px-6 pt-6 pb-4">
                                    <input type="number" v-model="selected_product.quantity" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </td>
                            <td class="border-t" colspan="2">
                                <div class="px-6 pt-6 pb-4">
                                    {{ (selected_product.quantity * selected_product.price).toLocaleString(
                                    undefined, // leave undefined to use the visitor's browser
                                    // locale or a string like 'en-US' to override it.
                                    { minimumFractionDigits: 2 }
                                ) }}
                                </div>
                            </td>
                            <td class="border-t">
                                <button class="btn" @click="removeSelectedProduct(index)"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg></button>
                            </td>
                        </tr>
                        <tr v-if="form.selected_products.length === 0">
                            <td class="border-t px-6 py-4 text-center" colspan="7">No products found.</td>
                        </tr>
                        <tr class="border-t text-right font-bold">
                            <th class="px-6 pt-6 pb-4" colspan="4">Total</th>
                            <th class="px-6 pt-6 pb-4" colspan="2">{{ total_amount }}</th>
                        </tr>
                    </table>
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
        suppliers: Object,
        products: Object
    },
    computed: {
        total_amount() {
            let sum = 0;
            this.form.selected_products.forEach(product => {
                sum += (product.price * product.quantity);
            });
            return sum.toLocaleString(undefined, {minimumFractionDigits: 2});
        }
    },
    data() {
        return {
            page_title: 'Receiving',
            page_title_plural: 'Receiving',
            page_action: 'Update',
            page_action_title: 'Create Receiving',
            submit_action_label: 'Save',
            route_index: 'inventories.index',
            route_create: 'inventories.create',
            route_edit: 'inventories.edit',
            route_store: 'inventories.store',
            showModal: false,
            price: null,
            quantity: null,
            product_id: null,
            form: this.$inertia.form({
                supplier_id: null,
                selected_products: []
            })
        }

    },
    methods: {
        store() {
            this.form.post(this.route(this.route_store))
            // console.log(this.form.selected_products);
        },
        openModal() {
            this.showModal = !this.shoxwModal;
        },
        addToSelectedProducts() {
            // check if already in selected
            if(this.form.selected_products)
            {
                let selected_product = this.form.selected_products.find(product => product.id === this.product_id);

                console.log(selected_product);
                if(selected_product)
                {
                    selected_product.quantity += this.quantity;
                    selected_product.price = this.price;
                    this.quantity = null;
                    this.price = null;
                    this.product_id = null;
                    return;
                }
            }
            let product = this.products.find(product => product.id === this.product_id);
            product = Object.assign({}, product);

            product.quantity = this.quantity;
            product.price = this.price;
            this.form.selected_products.push(product);

            this.quantity = null;
            this.price = null;
            this.product_id = null;
        },
        removeSelectedProduct(index) {
            this.form.selected_products.splice(index, 1);
        }
    },
}
</script>
