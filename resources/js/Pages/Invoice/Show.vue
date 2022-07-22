<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/Authenticated.vue'
import ClientDisplay from '@/Components/Forms/ClientDisplay.vue'
import SalesForm from '@/Components/Forms/SalesForm.vue'
import PaymentForm from '@/Components/Forms/PaymentForm.vue'
import ProductDisplay from '@/Components/Forms/ProductDisplay.vue'
import PostageDisplay from '@/Components/Forms/PostageDisplay.vue'
import SalesDisplay from '@/Components/Forms/SalesDisplay.vue'
import PaymentDisplay from '@/Components/Forms/PaymentDisplay.vue'
import Tabs from '@/Components/Tabs.vue'
import Tab from '@/Components/Tab.vue'
import moment from 'moment'

import { QuillEditor } from '@vueup/vue-quill'
import ImageUploader from 'quill-image-uploader'
import BlotFormatter from 'quill-blot-formatter'
import ImageCompress from 'quill-image-compress'
import 'quill-paste-smart'
import '@vueup/vue-quill/dist/vue-quill.snow.css'

export default {
    props: {
        order: Boolean,
        client: Boolean,
        invoice: Object,
        states: Object,
        token: String
    },
    components: {
        AppLayout,
        Link,
        Head,
        ClientDisplay,
        ProductDisplay,
        SalesForm,
        PaymentForm,
        PostageDisplay,
        SalesDisplay,
        PaymentDisplay,
        QuillEditor,
        Tabs,
        Tab
    },
    data() {
        return {
            clientForm: this.$inertia.form({
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

            noteForm: this.$inertia.form({
                invoice_id: this.invoice.Id,
                note: ''
            }),

            invoiceForm: this.$inertia.form({
                invoice_id: this.invoice.Id,
                client: this.invoice.client.id,
                Orderstatus: this.invoice.Orderstatus,
                products: {
                    grand_total: this.invoice.Grand_Total,
                    items: [
                        {
                            product: this.invoice.Product,
                            product_name: this.invoice.product?.Product_Name,
                            price: this.invoice.Price,
                            qty: this.invoice.Qty,
                            discount: this.invoice.Discount,
                            discounted_price: 0,
                            total: this.invoice.Total_RM
                        },
                        {
                            product: this.invoice.Product_2,
                            product_name: this.invoice.product2?.Product_Name,
                            price: this.invoice.Price_2,
                            qty: this.invoice.Qty_2,
                            discount: this.invoice.Discount_2,
                            discounted_price: 0,
                            total: this.invoice.Total_RM_2
                        },
                        {
                            product: this.invoice.Product_3,
                            product_name: this.invoice.product3?.Product_Name,
                            price: this.invoice.Price_3,
                            qty: this.invoice.Qty_3,
                            discount: this.invoice.Discount_3,
                            discounted_price: 0,
                            total: this.invoice.Total_RM_3
                        },
                        {
                            product: this.invoice.Product_4,
                            product_name: this.invoice.product4?.Product_Name,
                            price: this.invoice.Price_4,
                            qty: this.invoice.Qty_4,
                            discount: this.invoice.Discount_4,
                            discounted_price: 0,
                            total: this.invoice.Total_RM_4
                        },
                        {
                            product: this.invoice.Product_5,
                            product_name: this.invoice.product5?.Product_Name,
                            price: this.invoice.Price_5,
                            qty: this.invoice.Qty_5,
                            discount: this.invoice.Discount_5,
                            discounted_price: 0,
                            total: this.invoice.Total_RM_5
                        },
                        {
                            product: this.invoice.Product_6,
                            product_name: this.invoice.product6?.Product_Name,
                            price: this.invoice.Price_6,
                            qty: this.invoice.Qty_6,
                            discount: this.invoice.Discount_6,
                            discounted_price: 0,
                            total: this.invoice.Total_RM_6
                        },
                        {
                            product: this.invoice.Product_7,
                            product_name: this.invoice.product7?.Product_Name,
                            price: this.invoice.Price_7,
                            qty: this.invoice.Qty_7,
                            discount: this.invoice.Discount_7,
                            discounted_price: 0,
                            total: this.invoice.Total_RM_7
                        },
                        {
                            product: this.invoice.Product_8,
                            product_name: this.invoice.product8?.Product_Name,
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
                    consultant: this.invoice.consultant?.Name,
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
    created: function () {
        this.moment = moment
    },
    methods: {
        openPDF(data) {
            window.open(
                route('portfolio.invoice.pdf', { invoice: data.Id }),
                '_blank'
            )
        },
        openDocket(data) {
            window.open(
                route('portfolio.invoice.docket', { invoice: data.Id }),
                '_blank'
            )
        },
        storeNote() {
            this.noteForm.post(route('portfolio.invoice.note'))
        }
    },

    setup: () => {
        const modules = [
            {
                name: 'modules/imageCompress',
                module: ImageCompress,
                options: {
                    /* options */
                }
            },
            {
                name: 'modules/blotFormatter',
                module: BlotFormatter,
                options: {
                    /* options */
                }
            },
            {
                name: 'modules/imageUploader',
                module: ImageUploader,
                options: {
                    upload: (file) => {
                        return new Promise((resolve, reject) => {
                            const formData = new FormData()
                            formData.append('image', file)
                            formData.append(
                                '_token',
                                document.querySelector('#token').value
                            )
                            formData.append(
                                'invoice_id',
                                document.querySelector('#inv').value
                            )

                            fetch(route('portfolio.image.upload.post'), {
                                method: 'POST',
                                body: formData
                            })
                                .then((response) => response.json())
                                .then((result) => {
                                    resolve(result.path)
                                })
                                .catch((error) => {
                                    reject('Upload failed')
                                    console.error('Error:', error)
                                })
                        })
                    }
                }
            }
        ]
        return { modules }
    }
}
</script>
<template>
    <Head title="Create Invoice" />
    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="my-modal" class="modal-toggle" />
    <div class="modal">
        <div
            class="modal-box w-full lg:max-w-xl xl:max-w-7xl h-[80vh] relative"
        >
            <label
                for="my-modal"
                class="btn btn-sm btn-circle btn-primary absolute right-2 top-2"
                >✕</label
            >
            <div class="h-96">
                <h3 class="font-bold text-lg">Add note</h3>
                <QuillEditor
                    theme="snow"
                    toolbar="full"
                    v-model:content="noteForm.note"
                    contentType="html"
                    class="bg-white"
                    :modules="modules"
                />
                <button class="btn btn-block btn-sm" @click="storeNote">
                    Submit
                </button>
            </div>
        </div>
    </div>
    <AppLayout>
        <input type="hidden" :value="$page.props.token" id="token" /><input
            type="hidden"
            :value="invoice.Id"
            id="inv"
        />
        <h1
            class="mb-8 text-2xl font-bold flex gap-2 items-center flex gap-2 items-center"
        >
            <Link class="text-primary hover:text-primary-focus" href="/invoice"
                >Invoice</Link
            >
            <span class="text-primary font-medium">/</span> {{ invoice.Inv_No }}
        </h1>

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

            <div class="menu menu-horizontal">
                <!-- The button to open modal -->
                <label
                    for="my-modal"
                    class="btn btn-ghost btn-sm modal-button"
                    v-if="hasAnyPermission(['note-edit'])"
                    title="Notes"
                >
                    <i class="bi bi-journal-text text-xl"></i
                ></label>

                <Link
                    :href="
                        route('portfolio.invoice.edit', { invoice: invoice.Id })
                    "
                    v-if="hasAnyPermission(['invoice-edit'])"
                    class="btn btn-ghost btn-sm"
                    title="Edit Invoice"
                >
                    Edit
                </Link>
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-sm"
                        >Print</label
                    >
                    <ul
                        tabindex="0"
                        class="dropdown-content menu p-2 shadow-xl bg-base-100 rounded-box w-52"
                    >
                        <li>
                            <div
                                @click="openPDF(invoice)"
                                class="hover:cursor-pointer w-full"
                            >
                                Invoice
                            </div>
                        </li>
                        <li>
                            <div
                                @click="openDocket(invoice)"
                                class="hover:cursor-pointer w-full"
                            >
                                Docket
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 xl:grid-cols-1">
            <div class="my-3">
                <ClientDisplay
                    :client="invoice.client"
                    :states="$page.props.states"
                />
            </div>

            <div class="my-3">
                <div class="tabs">
                    <a class="tab tab-lifted tab-active">Postage</a>
                </div>
                <PostageDisplay
                    :states="$page.props.states"
                    :shipping="invoiceForm.shipping"
                />
            </div>

            <div class="my-3">
                <tabs>
                    <tab title="Product">
                        <ProductDisplay
                            :products="invoiceForm.products"
                            :productLists="$page.props.products"
                        />
                    </tab>
                    <tab title="Sales">
                        <SalesDisplay :sales="invoiceForm.sales" />
                    </tab>
                    <tab title="Payment">
                        <payment-display :payment="invoiceForm.payment" />
                    </tab>
                </tabs>
            </div>

            <div class="my-3">
                <div class="tabs">
                    <a class="tab tab-lifted tab-active">Invoice Notes</a>
                </div>
                <div class="overflow-y-scroll">
                    <div
                        class="bg-white p-4 rounded-sm shadow-xl m-3"
                        v-for="(note, i) in $page.props.invoice.notes"
                        :key="i"
                    >
                        <div v-html="note.Notes"></div>
                        <p class="text-sm text-gray-800 italic">
                            {{ note.Created_By }} ( {{ note.Created_On }} )
                        </p>
                    </div>
                </div>
            </div>
        </div>

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
    </AppLayout>
</template>
