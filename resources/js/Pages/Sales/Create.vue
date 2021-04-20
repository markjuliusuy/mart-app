<template>
    <div>

        <teleport to="head">
            <title>{{ page_action_title }}</title>
        </teleport>

        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="mt-6 bg-white rounded shadow">
                        <div class="">
                            <Multiselect v-model="value" :options="products" valueProp="id" label="sales_name" trackBy="sales_name" @select="chooseProduct" @close="clearSelect" :allowEmpty="false" :clearOnSelect="true" :searchable="true" :clearOnSearch="true"  placeholder="Select product" ref="multiselect"></Multiselect>
                            <jet-input-error :message="form.errors.product_id" class="mt-2"/>
                        </div>
                    </div>
                    <div class="mt-6 bg-white rounded shadow overflow-x-auto">
                        <table class="w-full ">
                           <thead>
                           <tr class="bg-gray-100 text-left font-bold">
                               <th class="px-6 pt-6 pb-4 w-4/12">Product</th>
                               <th class="px-6 pt-6 pb-4 w-3/12">Price</th>
                               <th class="px-6 pt-6 pb-4 w-1/12">Qty</th>
                               <th class="px-6 pt-6 pb-4 w-1/12">Discount</th>
                               <th class="px-6 pt-6 pb-4 w-1/12">Total</th>
                               <th class="px-6 pt-6 pb-4 w-1/12"></th>
                           </tr>
                           </thead>
                            <tbody>
                            <tr v-for="(selected_product, index) in form.selected_products" :key="selected_product.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                <td class="border-t">
                                    <div class="p-3">
                                        {{ selected_product.name }}
                                    </div>
                                </td>
                                <td class="border-t">
                                    <div class="p-3">
                                        <input type="number" step=".01" v-model="selected_product.price" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </td>
                                <td class="border-t">
                                    <div class="p-3">
                                        <input type="number" step=".01" v-model="selected_product.quantity" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </td>
                                <td class="border-t">
                                    <div class="p-3 text-center underline">
                                        <a href="#" @click="openDiscountModal('item', selected_product.id)">{{ displayDiscountText(selected_product.discount, selected_product.discount_type) }}</a>
                                    </div>
                                </td>
                                <td class="border-t">
                                    <div v-if="parseFloat(selected_product.discount)">
                                        <div class="text-center line-through">
                                            {{ (selected_product.price * selected_product.quantity).toLocaleString(undefined,{ minimumFractionDigits: 2 }) }}
                                        </div>
                                    </div>
                                    <div class="p-3 text-center">
                                        {{ getTotalPrice(selected_product).toLocaleString(undefined,{ minimumFractionDigits: 2 }) }}
                                    </div>
                                </td>
                                <td class="border-t">
                                    <button class="btn" @click="removeSelectedProduct(index)"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg></button>
                                </td>
                            </tr>
                            <tr v-if="form.selected_products.length === 0" class="border-b">
                                <td class="border-t px-6 py-4 text-center font-bold text-2xl" colspan="7">There are no items in the cart</td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
            </div>

            <div class="md:col-span-1 items-start">
                <div class="w-full mt-6 bg-white rounded shadow overflow-x-auto">
                    <div class="px-4 py-4 border-b">
                        <div class="flex justify-between">
                            <label class="block font-medium text-sm text-gray-700" for="customer_id">Customer</label>
                        </div>
                        <Multiselect v-model="form.customer_id"  :options="customers" valueProp="id" label="name"  :searchable="true" :close-on-select="false" :show-labels="false" placeholder="Walk-in customer"></Multiselect>

                        <jet-input-error :message="form.errors.supplier_id" class="mt-2"/>
                    </div>
                    <div class="px-4 py-4 flex justify-between">
                        <div>Subtotal</div>
                        <div>
                            {{ subtotal.toLocaleString(undefined, { minimumFractionDigits: 2 }) }}
                        </div>
                    </div>

                    <div class="px-4 py-4 flex justify-between">
                        <div>Discount</div>
                        <div class="text-right underline">
                            <a href="#" @click="openDiscountModal('cart', '')">
                                {{ displayDiscountText(form.discount_value, form.discount_type) }}</a>
                        </div>
                    </div>
                    <div class="border-t px-4 py-4 flex justify-between font-bold text-2xl">
                        <div><span>Grand Total</span></div>
                        <div>
                            {{ grand_total.toLocaleString(undefined, {minimumFractionDigits: 2}) }}
                        </div>
                    </div>
                </div>
                <div class="w-full mt-6 bg-white rounded show overflow-x-auto">
                    <div class="">
                        <button @click="openPaymentModal"  class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-2 md:text-lg md:px-10" type="submit">
                            {{ submit_action_label }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" :class="{ 'hidden': !showPaymentModal }">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!--
                  Background overlay, show/hide based on modal state.

                  Entering: "ease-out duration-300"
                    From: "opacity-0"
                    To: "opacity-100"
                  Leaving: "ease-in duration-200"
                    From: "opacity-100"
                    To: "opacity-0"
                -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!--
                  Modal panel, show/hide based on modal state.

                  Entering: "ease-out duration-300"
                    From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    To: "opacity-100 translate-y-0 sm:scale-100"
                  Leaving: "ease-in duration-200"
                    From: "opacity-100 translate-y-0 sm:scale-100"
                    To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                -->

                <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full">
                    <form @submit.prevent="store">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="w-full">

                                    <div class="flex justify-between font-bold text-2xl">
                                        <div><span>Grand Total</span></div>
                                        <div>
                                            {{ grand_total.toLocaleString(undefined, { minimumFractionDigits: 2 }) }}
                                        </div>
                                    </div>
                                    <div class="mt-4 flex justify-between font-bold text-lg items-center">
                                        <jet-label for="tendered_amount" value="Amount Tendered" class="w-4/12 font-bold text-lg"/>
                                        <input  type="number" step=".01" name="tendered_amount" id="tendered_amount" v-model="form.tendered_amount" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-8/12 text-right" ref="tendered_amount">
                                        <jet-input-error :message="form.errors.tendered_amount" class="mt-2"/>
                                    </div>
                                    <div class="mt-4 flex justify-between font-bold text-lg items-center">
                                        <jet-label for="change" value="Change" class="w-4/12 font-bold text-lg"/>
                                        <jet-input id="change_amount" type="text" class="mt-1 block w-8/12 disabled:opacity-50 text-right" disabled v-model="change_amount"/>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" :disabled="form.processing" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo500 sm:ml-3 sm:w-auto sm:text-sm">
                            <div v-if="form.processing" class="btn-spinner mr-2"/>
                            Submit
                        </button>
                        <button @click="showPaymentModal = !showPaymentModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                    </form>

                </div>

            </div>
        </div>


        <jet-dialog-modal :show="showDiscountModal" max-width="sm">

            <template #content>
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="discount_type">
                        Select Discount
                    </label>
                    <select name="discount_id" id="discount_id" v-model="discount_form.discount_id" @change="selectDiscount" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Select discount">
                        <option value="0">Select Discount</option>
                        <option v-for="discount in discounts" :value="discount.id">{{ discount.name }}</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="discount_type">
                        Discount Type
                    </label>
                    <select name="discount_type" id="discount_type" v-model="discount_form.discount_type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="percent">Percent %</option>
                        <option value="fixed">Fixed</option>
                    </select>
                </div>
                <div class="mt-4">
                    <jet-label for="discount_form_amount" value="Discount"/>
                    <jet-input id="discount_form_amount" type="number" step=".01" class="mt-1 block w-full" v-model="discount_form.discount" :error="discount_form.errors.discount"/>
                    <jet-input-error :message="discount_form.errors.discount" class="mt-2"/>
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    Cancel
                </jet-secondary-button>

                <jet-button class="ml-2" @click="saveDiscount" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </jet-button>
            </template>
        </jet-dialog-modal>
    </div>
</template>
<style src="@vueform/multiselect/themes/default.css"></style>
<script>
import AppLayout from '@/Layouts/AppLayout'
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetDialogModal from '@/Jetstream/DialogModal';
import JetButton from '@/Jetstream/Button';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';
import Multiselect from '@vueform/multiselect';

export default {
    components: {
        JetInput,
        JetInputError,
        JetLabel,
        JetDialogModal,
        JetButton,
        JetSecondaryButton,
        Multiselect
    },
    layout: AppLayout,
    props: {
        discounts: Object,
        customers: Object,
        products: Object,
    },
    computed: {
        subtotal() {
            let sum = 0;
            this.form.selected_products.forEach(product => {
                sum += this.getTotalPrice(product);
            });
            return sum;
        },
        discount_amount() {
            let discount = this.form.discount_value;

            if(this.form.discount_type === 'percent')
            {
                discount = this.subtotal * (this.form.discount_value/100);
            }

            return discount;
        },
        grand_total() {
            return this.subtotal - this.discount_amount;
        },
        change_amount() {
            this.form.change_amount = this.form.tendered_amount - this.grand_total;
            return this.form.change_amount.toLocaleString(undefined, { minimumFractionDigits: 2 });;
        }
    },
    data() {
        return {
            value: null,
            showDiscountModal: false,
            showPaymentModal: false,
            page_title: 'Sale',
            page_title_plural: 'Sales',
            page_action: 'Update',
            page_action_title: 'Create Sale',
            submit_action_label: 'Pay',
            route_index: 'sales.index',
            route_create: 'sales.create',
            route_edit: 'sales.edit',
            route_store: 'sales.store',
            showModal: false,
            price: null,
            quantity: null,
            product_id: null,
            discount_id: null,
            form: this.$inertia.form({
                customer_id: null,
                selected_products: [],
                subtotal_amount: 0,
                total_amount: 0,
                tendered_amount: 0,
                change_amount: 0,
                grand_total: 0,
                discount_amount: 0,
                discount_type: 'percent',
                discount_value: 0,
                discount_id: null,
                transaction_type: 'sale',
                notes: '',
            }),
            discount_form: {
                apply_discount: null,
                product_id: null,
                discount_type: 'percent',
                discount: 0,
                discount_id: 0,
                errors: {
                    discount_type: '',
                    discount: ''
                }
            }
        }

    },
    methods: {
        store() {
            let $this = this;
            this.form.subtotal_amount = this.subtotal;
            this.form.grand_total = this.grand_total;
            this.form.discount_amount = this.discount_amount;
            this.form.post(this.route(this.route_store), {
                onSuccess: function (data) {
                    console.log(data);
                    $this.form.reset();
                    $this.showPaymentModal = false;
                }
            })
        },
        chooseProduct(id) {
            // check if already in selected
            if(this.form.selected_products)
            {
                let selected_product = this.form.selected_products.find(product => product.id === id);

                if(selected_product)
                {
                    selected_product.quantity = parseInt(selected_product.quantity) + 1;
                    this.product_id = null;
                    return;
                }
            }
            let product = this.products.find(product => product.id === id);
            product = Object.assign({}, product);

            product.quantity = 1;
            product.discount = 0;
            product.discount_type = 'percent';
            product.total_amount = 0;
            product.discount_price = 0;
            this.form.selected_products.push(product);

            this.product_id = null;
        },
        clearSelect() {
            this.$refs.multiselect.clear();
        },
        removeSelectedProduct(index) {
            this.form.selected_products.splice(index, 1);
        },
        displayDiscountText(discount, discount_type)
        {
            let discount_label = (discount_type === 'percent') ? '%' : ''
            let discount_amount = parseFloat(discount).toLocaleString(undefined, { minimumFractionDigits: 2 });
            return discount_amount + discount_label;
        },
        openDiscountModal(type, id)
        {
            if(type === 'item')
            {
                let index = this.form.selected_products.findIndex(product => product.id === id);
                this.discount_form.discount_type = this.form.selected_products[index].discount_type;
                this.discount_form.discount = parseFloat(this.form.selected_products[index].discount);
                this.discount_form.product_id = id;
            }
            else {
                this.discount_form.discount_type = this.form.discount_type;
                this.discount_form.discount = parseFloat(this.form.discount_value);
            }

            this.discount_form.apply_discount = type;
            this.showDiscountModal = true;
        },
        openPaymentModal() {
            this.form.tendered_amount = this.grand_total;
            this.showPaymentModal = true;
            this.$nextTick(() => {
                this.$refs.tendered_amount.focus();
            });

        },
        closeModal()
        {
            this.showDiscountModal = false;
            this.showPaymentModal = false;
        },
        saveDiscount()
        {
            if( this.discount_form.apply_discount === 'item')
            {
                let index = this.form.selected_products.findIndex(product => product.id === this.discount_form.product_id);
                this.form.selected_products[index].discount_type = this.discount_form.discount_type;
                this.form.selected_products[index].discount = this.discount_form.discount;
            } else {
                this.form.discount_type = this.discount_form.discount_type;
                this.form.discount_value = this.discount_form.discount;
            }

            this.showDiscountModal = false;
            this.discount_form.discount_type = 'percent';
            this.discount_form.discount = 0;
            this.discount_form.product_id = null;
        },
        getTotalPrice(selected_product)
        {
            let total_price = 0;
            if(selected_product.discount_type === 'percent')
            {
                selected_product.discount_price = selected_product.price - ( selected_product.price * (selected_product.discount/100) );
                total_price = (selected_product.quantity * (selected_product.discount_price) );
            } else {
                selected_product.discount_price = (selected_product.price - selected_product.discount );
                total_price = (selected_product.quantity * selected_product.discount_price);
            }
            selected_product.total_amount = total_price;
            return total_price;
        },
        selectDiscount()
        {
            if(this.discount_form.discount_id)
            {
                let index = this.discounts.findIndex(discount => discount.id === this.discount_form.discount_id);
                this.discount_form.discount_type = this.discounts[index].type;
                this.discount_form.discount = this.discounts[index].value;

                this.form.discount_value = this.discounts[index].value;
                this.form.discount_type = this.discounts[index].type;
                this.form.discount_id = this.discounts[index].id;
            } else {
                this.form.discount_value = 0;
                this.form.discount_type = 'percent';
                this.form.discount_id = null;
            }
        }
    },
}
</script>
