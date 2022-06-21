<script>
import { Link,Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import ClientDisplay from '@/Components/Forms/ClientDisplay.vue'
import SalesForm from '@/Components/Forms/SalesForm.vue'
import PaymentForm from '@/Components/Forms/PaymentForm.vue'
import ProductDisplay from '@/Components/Forms/ProductDisplay.vue';
import PostageDisplay from '@/Components/Forms/PostageDisplay.vue';
import SalesDisplay from '@/Components/Forms/SalesDisplay.vue';
import PaymentDisplay from '@/Components/Forms/PaymentDisplay.vue';
// import TipTap from '@/Components/TipTap.vue'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';


export default {
    props:{
        order:Boolean,
        client:Boolean,
        invoice:Object,
        states:Object
    },
    components:{
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
    // TipTap
        QuillEditor
},
data() {
        return {
            clientForm:this.$inertia.form({
                    MyKad_SSM:this.invoice.client.MyKad_SSM,
                    Name:this.invoice.client.Name,
                    Mobile_No:this.invoice.client.Mobile_No,
                    Phone:this.invoice.client.Phone,
                    Off_Phone:this.invoice.client.Off_Phone,
                    Address:this.invoice.client.Address,
                    Address_2:this.invoice.client.Address_2,
                    Poscode:this.invoice.client.Poscode,
                    City:this.invoice.client.City,
                    State:this.invoice.client.State,
                    Country:this.invoice.client.Country
            }),
            noteForm:this.$inertia.form({
                note:"Note"
            }),
            invoiceForm: this.$inertia.form({
                client:this.invoice.client.id,
                products:{
                grand_total:this.invoice.Grand_Total,
                items:[
                    {
                        product:this.invoice.Product,
                        product_name:this.invoice.product?.Product_Name,
                        price : this.invoice.Price,
                        qty : this.invoice.Qty,
                        discount : this.invoice.Discount,
                        discounted_price : 0,
                        total : this.invoice.Total_RM,
                    },{
                         product:this.invoice.Product_2,
                        product_name:this.invoice.product2?.Product_Name,
                        price : this.invoice.Price_2,
                        qty : this.invoice.Qty_2,
                        discount : this.invoice.Discount_2,
                        discounted_price : 0,
                        total : this.invoice.Total_RM_2,
                    }, {
                         product:this.invoice.Product_3,
                        product_name:this.invoice.product3?.Product_Name,
                        price : this.invoice.Price_3,
                        qty : this.invoice.Qty_3,
                        discount : this.invoice.Discount_3,
                        discounted_price : 0,
                        total : this.invoice.Total_RM_3,
                    }, {
                         product:this.invoice.Product_4,
                        product_name:this.invoice.product4?.Product_Name,
                        price : this.invoice.Price_4,
                        qty : this.invoice.Qty_4,
                        discount : this.invoice.Discount_4,
                        discounted_price : 0,
                        total : this.invoice.Total_RM_4,
                    }, {
                         product:this.invoice.Product_5,
                        product_name:this.invoice.product5?.Product_Name,
                        price : this.invoice.Price_5,
                        qty : this.invoice.Qty_5,
                        discount : this.invoice.Discount_5,
                        discounted_price : 0,
                        total : this.invoice.Total_RM_5,
                    },{
                         product:this.invoice.Product_6,
                        product_name:this.invoice.product6?.Product_Name,
                        price : this.invoice.Price_6,
                        qty : this.invoice.Qty_6,
                        discount : this.invoice.Discount_6,
                        discounted_price : 0,
                        total : this.invoice.Total_RM_6,
                    },{
                         product:this.invoice.Product_7,
                        product_name:this.invoice.product7?.Product_Name,
                        price : this.invoice.Price_7,
                        qty : this.invoice.Qty_7,
                        discount : this.invoice.Discount_7,
                        discounted_price : 0,
                        total : this.invoice.Total_RM_7,
                    },{
                         product:this.invoice.Product_8,
                        product_name:this.invoice.product8?.Product_Name,
                        price : this.invoice.Price_8,
                        qty : this.invoice.Qty_8,
                        discount : this.invoice.Discount_8,
                        discounted_price : 0,
                        total : this.invoice.Total_RM_8,
                    }
                ]},
                payment:{
                    total_settlement:"",
                    items:[
                    {
                        ptp:this.invoice.Promise_pay,
                        settlement:this.invoice.Payment1
                    }, {
                        ptp:this.invoice.Promise_pay2,
                        settlement:this.invoice.Payment2
                    }, {
                        ptp:this.invoice.Promise_pay3,
                        settlement:this.invoice.Payment3
                    }, {
                        ptp:this.invoice.Promise_pay4,
                        settlement:this.invoice.Payment4
                    }

                ]},
                sales:{
                    consultant:this.invoice.consultant?.Name,
                    channel:this.invoice.Channel,
                    closing:""
                },
                shipping:{
                    Ship_Name:this.invoice.Ship_Name,
                    Ship_Phone:this.invoice.Ship_Phone,
                    Ship_Add1:this.invoice.Ship_Add1,
                    Ship_Add2:this.invoice.Ship_Add2,
                    Ship_poscode:this.invoice.Ship_poscode,
                    Ship_City:this.invoice.Ship_City,
                    Ship_State:this.invoice.Ship_State,
                    Ship_Country:this.invoice.Ship_Country
                }
            }),
        };
    },
    methods: {
        openPDF(data){
            window.open(route('portfolio.invoice.pdf',{'invoice': data.Id}), '_blank')
        },
        openDocket(data){
            window.open(route('portfolio.invoice.docket',{'invoice': data.Id}), '_blank')
        }
    },

}

</script>
<template>

    <Head title="Create Invoice" />
    <AppLayout>

        <!-- Put this part before </body> tag -->
        <div class="modal" id="my-modal-2">
            <div class="modal-box">
                <QuillEditor theme="snow" toolbar="full" v-model:content="noteForm.note" contentType="html" />
                <!-- <TipTap v-model="noteForm.note" /> -->
                <div class="bg-white p-4 rounded-sm shadow-xl m-3" v-for="note,i in $page.props.invoice.notes" :key="i">
                    <div class="textarea textarea-ghost" v-html="note.Notes">
                    </div>
                    <p class="text-sm text-gray-800">{{ note.Created_By }}</p>
                    <p class="text-sm text-gray-800">{{ note.Created_On }}</p>
                </div>

                <div class="modal-action">
                    <a href="#" class="btn">Yay!</a>
                </div>
            </div>
        </div>

        <h1 class="mb-8 text-2xl font-bold flex gap-2 items-center flex gap-2 items-center">
            <Link class="text-primary hover:text-primary-focus" href="/invoice">Invoice</Link>
            <span class="text-primary font-medium">/</span>View {{invoice.Inv_No}} <span class="badge text-white"
                :class='invoice.Status_Inv == "PAID" ? "badge-success " : "badge-error"'> {{invoice.Status_Inv}}</span>
        </h1>
        <div class="flex items-center justify-end">
            <!-- The button to open modal -->
            <a href="#my-modal-2" class="btn btn-ghost"><i class="bi bi-journal-text text-xl"
                    v-if="hasAnyPermission(['note-edit'])"></i></a>

            <Link :href="route('portfolio.invoice.edit', {invoice:invoice.Id})"
                v-if="hasAnyPermission(['invoice-edit'])" class="btn btn-ghost">
            <i class="bi bi-pencil-square  text-xl"></i>
            </Link>
            <button @click="openPDF(invoice)" class="btn btn-ghost btn-sm" title="Print Invoice">
                <i class="bi bi-printer text-xl"></i>
            </button>
            <button @click="openDocket(invoice)" class="btn btn-ghost btn-sm" title="Print Docket">
                <i class="bi bi-printer-fill text-xl"></i>
            </button>
        </div>
        <div class="grid grid-cols-1 xl:grid-cols-1">
            <div class="my-3">
                <div class="divider text-xl" id="client">Client</div>
                <ClientDisplay :client="invoice.client" :states="$page.props.states" />
            </div>

            <div class="my-3">
                <div class="divider text-xl" id="postage">Postage</div>
                <PostageDisplay :states="$page.props.states" :shipping="invoiceForm.shipping" />
            </div>

            <div class="my-3">
                <div class="divider text-xl" id="product">Product</div>
                <ProductDisplay :products="invoiceForm.products" :productLists="$page.props.products" />
            </div>

            <div class="my-3">
                <div class="divider text-xl" id="sales">Sales</div>
                <SalesDisplay :sales="invoiceForm.sales" />
            </div>

            <div class="my-3">
                <div class="divider text-xl" id="sales">Payment</div>
                <payment-display :payment="invoiceForm.payment" />
            </div>
        </div>
    </AppLayout>

</template>
