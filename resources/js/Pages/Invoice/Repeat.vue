<script>
import { Link, Head } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/Authenticated.vue'
import ClientForm from '@/Components/Forms/ClientForm.vue'
import ProductForm from '@/Components/Forms/ProductForm.vue'
import SalesForm from '@/Components/Forms/SalesForm.vue'
import PaymentForm from '@/Components/Forms/PaymentForm.vue'
import ClientDisplay from '@/Components/Forms/ClientDisplay.vue'
import PostageForm from '@/Components/Forms/PostageForm.vue'
import BreezeButton from '@/Components/Button.vue'
import moment from 'moment'
import BreezeLabel from '@/Components/Label.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeInputError from '@/Components/InputError.vue'

export default {
    props: ['client', 'invoice'],
    components: {
        AppLayout,
        BreezeButton,
        Link,
        Head,
        ClientForm,
        ClientDisplay,
        ProductForm,
        SalesForm,
        PaymentForm,
        PostageForm,
        BreezeLabel,
        BreezeInput,
        BreezeInputError
    },
    created: function () {
        this.moment = moment
    },
    data() {
        return {
            clientForm: this.$inertia.form({
                id: this.invoice.client.id,
                MyKad_SSM: this.invoice.client.MyKad_SSM,
                Name: this.invoice.client.Name,
                Mobile_No: this.invoice.client.Mobile_No,
                Phone: this.invoice.client.Phone,
                Off_Phone: this.invoice.client.Off_Phone,
                Address: this.invoice.client.Address,
                Address_2: this.invoice.client.Address_2,
                Poscode: this.invoice.client.Poscode,
                City: this.invoice.client.City,
                State: this.invoice.client.State,
                Country: this.invoice.client.Country
            }),
            invoiceForm: this.$inertia.form({
                client: this.invoice.client.id,
                Orderstatus: 'REPEAT',
                products: {
                    grand_total: this.invoice.Grand_Total,
                    items: [
                        {
                            product: this.invoice.Product,
                            price: this.invoice.Price,
                            qty: this.invoice.Qty,
                            discount: this.invoice.Discount,
                            discounted_price: 0,
                            total: this.invoice.Total_RM
                        },
                        {
                            product: this.invoice.Product_2,
                            price: this.invoice.Price_2,
                            qty: this.invoice.Qty_2,
                            discount: this.invoice.Discount_2,
                            discounted_price: 0,
                            total: this.invoice.Total_RM_2
                        },
                        {
                            product: this.invoice.Product_3,
                            price: this.invoice.Price_3,
                            qty: this.invoice.Qty_3,
                            discount: this.invoice.Discount_3,
                            discounted_price: 0,
                            total: this.invoice.Total_RM_3
                        },
                        {
                            product: this.invoice.Product_4,
                            price: this.invoice.Price_4,
                            qty: this.invoice.Qty_4,
                            discount: this.invoice.Discount_4,
                            discounted_price: 0,
                            total: this.invoice.Total_RM_4
                        },
                        {
                            product: this.invoice.Product_5,
                            price: this.invoice.Price_5,
                            qty: this.invoice.Qty_5,
                            discount: this.invoice.Discount_5,
                            discounted_price: 0,
                            total: this.invoice.Total_RM_5
                        },
                        {
                            product: this.invoice.Product_6,
                            price: this.invoice.Price_6,
                            qty: this.invoice.Qty_6,
                            discount: this.invoice.Discount_6,
                            discounted_price: 0,
                            total: this.invoice.Total_RM_6
                        },
                        {
                            product: this.invoice.Product_7,
                            price: this.invoice.Price_7,
                            qty: this.invoice.Qty_7,
                            discount: this.invoice.Discount_7,
                            discounted_price: 0,
                            total: this.invoice.Total_RM_7
                        },
                        {
                            product: this.invoice.Product_8,
                            price: this.invoice.Price_8,
                            qty: this.invoice.Qty_8,
                            discount: this.invoice.Discount_8,
                            discounted_price: 0,
                            total: this.invoice.Total_RM_8
                        }
                    ]
                },
                payment: {
                    occupation: this.invoice.occupation_code,
                    total_settlement: '',
                    items: [
                        {
                            ptp: '',
                            settlement: 0
                        },
                        {
                            ptp: '',
                            settlement: 0
                        },
                        {
                            ptp: '',
                            settlement: 0
                        },
                        {
                            ptp: '',
                            settlement: 0
                        }
                    ]
                },
                sales: {
                    consultant: '',
                    channel: '',
                    closing: ''
                },
                shipping: {
                    Ship_Name: '',
                    Ship_Phone: '',
                    Ship_Add1: '',
                    Ship_Add2: '',
                    Ship_poscode: '',
                    Ship_City: '',
                    Ship_State: '',
                    Ship_Country: ''
                }
            })
        }
    },
    methods: {
        storeInvoice() {
            this.invoiceForm.post(route('portfolio.invoice.store'))
        },

        storeClient() {
            this.form.post(route('portfolio.client.store'), {
                errorBag: 'storeClient',
                preserveScroll: true,
                onFinish: () => {
                    this.showUpdateForm = false
                }
            })
        },

        copyAddress() {
            this.invoiceForm.shipping.Ship_Name = this.clientForm.Name
            this.invoiceForm.shipping.Ship_Phone = this.clientForm.Mobile_No
            this.invoiceForm.shipping.Ship_Add1 = this.clientForm.Address
            this.invoiceForm.shipping.Ship_Add2 = this.clientForm.Address_2
            this.invoiceForm.shipping.Ship_poscode = this.clientForm.Poscode
            this.invoiceForm.shipping.Ship_City = this.clientForm.City
            this.invoiceForm.shipping.Ship_State = this.clientForm.State
            this.invoiceForm.shipping.Ship_Country = this.clientForm.Country
        },
        clearAddress() {
            this.invoiceForm.shipping.Ship_Name = ''
            this.invoiceForm.shipping.Ship_Phone = ''
            this.invoiceForm.shipping.Ship_Add1 = ''
            this.invoiceForm.shipping.Ship_Add2 = ''
            this.invoiceForm.shipping.Ship_poscode = ''
            this.invoiceForm.shipping.Ship_City = ''
            this.invoiceForm.shipping.Ship_State = ''
            this.invoiceForm.shipping.Ship_Country = ''
        }
    }
}
</script>

<template>

    <Head title="Quick Order" />
    <app-layout>
        <h1 class="mb-4 text-xl font-bold flex gap-2 items-center">
            <Link class="text-primary hover:text-primary-focus" href="/invoice">Invoice</Link>
            <span class="text-primary font-medium">/</span> Quick Order
        </h1>

        <form @submit.prevent="storeInvoice" class="form">
            <div class="flex items-center justify-between mb-4">
                <div class="flex flex-col">
                    <div class="stats stats-vertical lg:stats-horizontal bg-white" v-show="true">
                        <div class="stat">
                            <div class="stat-title">Order Status</div>
                            <div class="stat-value">
                                {{ invoiceForm.Orderstatus }}
                            </div>
                        </div>

                        <div class="stat">
                            <div class="stat-title">Status</div>
                            <div class="stat-value"></div>
                        </div>

                        <div class="stat">
                            <div class="stat-title">Aging</div>
                            <div class="stat-value">0 Days</div>
                        </div>

                        <div class="stat">
                            <div class="stat-title">Date</div>
                            <div class="stat-value">
                                {{ moment(new Date()).format('LL') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu menu-horizontal">
                    <BreezeButton :class="{ 'loading mr-3': invoiceForm.processing }"
                        :disabled="invoiceForm.processing">
                        Save
                    </BreezeButton>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-1">
                <div class="my-3">
                    <client-display :client="clientForm" :states="$page.props.states" />
                    <div class="md:flex md:items-center gap-4">
                        <div class="md:w-1/3">
                            <BreezeLabel value="Client Occupation" />
                        </div>
                        <div class="md:w-2/3">
                            <select name="Occupation" v-model="invoiceForm.payment.occupation"
                                class="input input-bordered input-sm w-full">
                                <option value="">Please select</option>
                                <option value="A">Gaji Bulanan</option>
                                <option value="B">
                                    Bekerja Sendiri/berniaga
                                </option>
                                <option value="C">Suri Rumah</option>
                                <option value="D">Goverment Staff</option>
                            </select>
                            <BreezeInputError :message="$page.props.errors.occupation" />
                        </div>

                        <div class="md:w-1/3">
                            <BreezeLabel value="Order Status" />
                        </div>
                        <div class="md:w-2/3">
                            <select v-model="invoiceForm.Orderstatus" class="input input-bordered input-sm w-full">
                                <option value="NEW">NEW</option>
                                <option value="REPEAT">REPEAT</option>
                                <option value="RESHUFFLE">RESHUFFLE</option>
                            </select>
                            <BreezeInputError :message="
                                $page.props.errors.updateInvoice?.hasOwnProperty(
                                    'sales.closing'
                                )
                                    ? $page.props.errors.updateInvoice[
                                    'sales.closing'
                                    ]
                                    : ''
                            " />
                        </div>
                    </div>
                </div>

                <div class="my-3">
                    <div class="divider text-xl" id="postage">Postage</div>
                    <div class="items-end justify-end btn-group">
                        <button @click="copyAddress" type="button" class="btn btn-outline btn-sm"
                            title="Copy Client Details">
                            <i class="bi bi-files"></i>
                        </button>

                        <button @click="clearAddress" type="button" class="btn btn-outline btn-sm"
                            title="Clear Postage Detail">
                            <i class="bi bi-eraser-fill"></i>
                        </button>
                    </div>
                    <postage-form :states="$page.props.states" :shipping="invoiceForm.shipping" />
                </div>

                <div class="my-3">
                    <div class="divider text-xl" id="product">Product</div>
                    <product-form :products="invoiceForm.products" :productLists="$page.props.products" />
                </div>

                <div class="my-3">
                    <div class="divider text-xl" id="sales">Sales</div>
                    <sales-form :consultants="$page.props.consultants" :sales="invoiceForm.sales"
                        :invoice="invoiceForm" />
                </div>

                <div class="my-3">
                    <div class="divider text-xl" id="sales">Payment</div>
                    <payment-form :payment="invoiceForm.payment" />
                </div>
            </div>
        </form>
    </app-layout>
</template>
