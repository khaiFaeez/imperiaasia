<script>
import { Link, Head } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/Authenticated.vue'
import ProductForm from '@/Components/Forms/ProductForm.vue'
import SalesForm from '@/Components/Forms/SalesForm.vue'
import PaymentForm from '@/Components/Forms/PaymentForm.vue'
import ClientDisplay from '@/Components/Forms/ClientDisplay.vue'
import PostageForm from '@/Components/Forms/PostageForm.vue'
import BreezeButton from '@/Components/Button.vue'
import moment from 'moment'

export default {
    props: ['client', 'invoice'],
    components: {
        AppLayout,
        Link,
        Head,
        ClientDisplay,
        ProductForm,
        SalesForm,
        PaymentForm,
        PostageForm,
        BreezeButton
    },

    created: function () {
        this.moment = moment
    },
    data() {
        return {
            componentKey: 0,
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
                Status_Inv: this.invoice.Status_Inv,
                Orderstatus: this.invoice.Orderstatus,
                client: this.invoice.client.id,
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
                    total_settlement: 0,
                    items: [
                        {
                            ptp: this.invoice.Promise_pay,
                            settlement: this.invoice.Payment1
                        },
                        {
                            ptp: this.invoice.Promise_pay2,
                            settlement: this.invoice.Payment2
                        },
                        {
                            ptp: this.invoice.Promise_pay3,
                            settlement: this.invoice.Payment3
                        },
                        {
                            ptp: this.invoice.Promise_pay4,
                            settlement: this.invoice.Payment4
                        }
                    ]
                },
                sales: {
                    consultant: this.invoice.consultant?.id,
                    channel: this.invoice.Channel,
                    closing: this.invoice.closing_code
                },
                shipping: {
                    Ship_Name: this.invoice.Ship_Name,
                    Ship_Phone: this.invoice.Ship_Phone,
                    Ship_Add1: this.invoice.Ship_Add1,
                    Ship_Add2: this.invoice.Ship_Add2,
                    Ship_poscode: this.invoice.Ship_poscode,
                    Ship_City: this.invoice.Ship_City,
                    Ship_State: this.invoice.Ship_State,
                    Ship_Country: this.invoice.Ship_Country
                }
            })
        }
    },
    methods: {
        forceRerender() {
            this.componentKey += 1
        },
        updateInvoice() {
            this.invoiceForm.put(
                route('portfolio.invoice.update', { invoice: this.invoice.Id }),
                {
                    errorBag: 'updateInvoice',
                    preserveScroll: true
                }
            )
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

            this.$page.props.errors.updateInvoice = {}
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
        },
        updatePayment() {
            this.invoiceForm.Status_Inv = 'PAID'
        },
        cancelOrder() {
            this.invoiceForm.Status_Inv = 'PAID'
            this.invoiceForm.products.items = [
                {
                    product: '',
                    price: 0,
                    qty: 0,
                    discount: 0,
                    discounted_price: 0,
                    total: 0
                },
                {
                    product: '',
                    price: 0,
                    qty: 0,
                    discount: 0,
                    discounted_price: 0,
                    total: 0
                },
                {
                    product: '',
                    price: 0,
                    qty: 0,
                    discount: 0,
                    discounted_price: 0,
                    total: 0
                },
                {
                    product: '',
                    price: 0,
                    qty: 0,
                    discount: 0,
                    discounted_price: 0,
                    total: 0
                },
                {
                    product: '',
                    price: 0,
                    qty: 0,
                    discount: 0,
                    discounted_price: 0,
                    total: 0
                },
                {
                    product: '',
                    price: 0,
                    qty: 0,
                    discount: 0,
                    discounted_price: 0,
                    total: 0
                },
                {
                    product: '',
                    price: 0,
                    qty: 0,
                    discount: 0,
                    discounted_price: 0,
                    total: 0
                },
                {
                    product: '',
                    price: 0,
                    qty: 0,
                    discount: 0,
                    discounted_price: 0,
                    total: 0
                }
            ]

            this.forceRerender()
        }
    }
}
</script>

<template>
    <Head title="Edit Invoice" />
    <app-layout>
        <h1 class="mb-4 text-xl font-bold flex gap-2 items-center">
            <Link class="text-primary hover:text-primary-focus" href="/invoice"
                >Invoice</Link
            >
            <span class="text-primary font-medium">/</span>
            {{ invoice.Inv_No }}
        </h1>

        <form @submit.prevent="updateInvoice" class="form">
            <div class="flex items-center justify-between mb-4">
                <div class="flex flex-col">
                    <div
                        class="stats stats-vertical lg:stats-horizontal bg-white"
                        v-show="true"
                    >
                        <div class="stat">
                            <div class="stat-title">Order Status</div>
                            <div class="stat-value">
                                {{ invoice.Orderstatus }}
                            </div>
                        </div>

                        <div class="stat">
                            <div class="stat-title">Status</div>
                            <div
                                class="stat-value"
                                :class="
                                    invoice.Status_Inv == 'PAID'
                                        ? 'text-success '
                                        : 'text-warning'
                                "
                            >
                                {{ invoice.Status_Inv }}
                            </div>
                        </div>

                        <div class="stat">
                            <div class="stat-title">Aging</div>
                            <div class="stat-value">
                                {{
                                    Math.abs(
                                        moment(invoice.Date, 'YYYY-MM-DD').diff(
                                            moment(new Date(), 'YYYY-MM-DD'),
                                            'days'
                                        )
                                    )
                                }}
                                Days
                            </div>
                        </div>

                        <div class="stat">
                            <div class="stat-title">Date</div>
                            <div class="stat-value">
                                {{ moment(invoice.Date).format('LL') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-group bg-white">
                    <button
                        type="button"
                        class="btn btn-sm btn-outline btn-primary"
                        v-show="invoice.Status_Inv == 'PENDING'"
                        @click="cancelOrder"
                    >
                        Cancel Order
                    </button>
                    <button
                        type="button"
                        class="btn btn-sm btn-outline btn-primary"
                        v-show="invoice.Status_Inv == 'PENDING'"
                        @click="updatePayment"
                    >
                        Update Payment
                    </button>

                    <Link
                        as="button"
                        type="button"
                        :href="
                            route('portfolio.invoice.show', {
                                invoice: invoice.Id
                            })
                        "
                        class="btn btn-sm btn-outline btn-primary"
                    >
                        Discard
                    </Link>

                    <BreezeButton
                        :class="{ 'loading mr-3': invoiceForm.processing }"
                        :disabled="invoiceForm.processing"
                    >
                        Save
                    </BreezeButton>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-1">
                <div class="my-3">
                    <client-display
                        :client="clientForm"
                        :states="$page.props.states"
                    />
                </div>

                <div class="my-3">
                    <div class="divider text-xl" id="postage">Postage</div>
                    <div class="flex items-end justify-end gap-2">
                        <button
                            @click="copyAddress"
                            type="button"
                            class="btn btn-ghost btn-sm"
                            title="Copy Client Details"
                        >
                            <i class="bi bi-files"></i>
                        </button>

                        <button
                            @click="clearAddress"
                            type="button"
                            class="btn btn-ghost btn-sm"
                            title="Clear Postage Detail"
                        >
                            <i class="bi bi-eraser-fill"></i>
                        </button>
                    </div>
                    <postage-form
                        :states="$page.props.states"
                        :shipping="invoiceForm.shipping"
                    />
                </div>

                <div class="my-3">
                    <div class="divider text-xl" id="product">Product</div>
                    <product-form
                        :products="invoiceForm.products"
                        :productLists="$page.props.products"
                        :key="componentKey"
                    />
                </div>

                <div class="my-3">
                    <div class="divider text-xl" id="sales">Sales</div>
                    <sales-form
                        :consultants="$page.props.consultants"
                        :sales="invoiceForm.sales"
                        :invoice="invoiceForm"
                    />
                </div>

                <div class="my-3">
                    <div class="divider text-xl" id="sales">Payment</div>
                    <payment-form :payment="invoiceForm.payment" />
                </div>
            </div>
        </form>
        <div>
            <p>
                Created By {{ invoice.Created_By }} at
                {{ invoice.Created_Date }}
            </p>
            <p>
                Last Edited By {{ invoice.Last_Edited_By }} at
                {{ invoice.Last_Edited_Date }}
            </p>
        </div>
    </app-layout>
</template>
