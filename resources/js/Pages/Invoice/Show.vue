<script>
import { Link,Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeInputError from  '@/Components/InputError.vue'
import ClientDisplay from '@/Components/Forms/ClientDisplay.vue'
import SalesForm from '@/Components/Forms/SalesForm.vue'
import PaymentForm from '@/Components/Forms/PaymentForm.vue'
import ProductDisplay from '@/Components/Forms/ProductDisplay.vue';
import PostageDisplay from '@/Components/Forms/PostageDisplay.vue';
import SalesDisplay from '@/Components/Forms/SalesDisplay.vue';


export default {
    props:{
        order:Boolean,
        client:Boolean,
        invoice:Object,
        states:Object
    },
    components:{
    AppLayout,
    BreezeLabel,
    BreezeButton,
    BreezeInput,
    BreezeInputError,
    Link,
    Head,
    ClientDisplay,
    ProductDisplay,
    SalesForm,
    PaymentForm,
    PostageDisplay,
    SalesDisplay
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
                    }
                ]},
                payment:{
                    total_settlement:"",
                    items:[
                    {
                        ptp:"",
                        settlement:""
                    }, {
                        ptp:"",
                        settlement:""
                    }, {
                        ptp:"",
                        settlement:""
                    }, {
                        ptp:"",
                        settlement:""
                    }

                ]},
                sales:{
                    consultant:this.invoice.consultant.Name,
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

        goToViewPage(data) {
            window.open(route('portfolio.invoice.show',{'invoice': data.Id}), '_self');
        },
        openPDF(data){
            window.open(route('portfolio.invoice.pdf',{'invoice': data.Id}), '_blank')
        }
    },

}

</script>
<template>
<Head title="Create Invoice" />
<AppLayout>
     <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-primary hover:text-primary-focus" href="/invoice">Invoice</Link>
      <span class="text-primary font-medium">/</span> {{invoice.Inv_No}}
    </h1>
    <section class="flex flex-row items-center justify-between mb-5">
        <div></div>
    <button @click="openPDF(invoice)" class="btn btn-info" >
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
</svg>
    Print
    </button>
</section>
<span ></span>
        <div class="divider text-xl" id="client">Client</div>
            <ClientDisplay
                :client="invoice.client"
                :states="$page.props.states"/>

            <div class="divider text-xl mb-8 mt-32 " id="postage">Postage</div>
            <PostageDisplay
                :states="$page.props.states"
                :shipping="invoiceForm.shipping"
            />

            <div class="divider text-xl mb-8 mt-32 " id="product">Product</div>
             <ProductDisplay
                :products="invoiceForm.products"
                :productLists="$page.props.products" />

            <div class="divider text-xl mb-8 mt-32" id="sales">Sales</div>
            <SalesDisplay
                :sales="invoiceForm.sales" />
</AppLayout>

</template>
