<script>
import { Link,Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeInputError from  '@/Components/InputError.vue'
import ClientForm from '@/Components/Forms/ClientForm.vue'
import ProductForm from '@/Components/Forms/ProductForm.vue'
import SalesForm from '@/Components/Forms/SalesForm.vue'
import PaymentForm from '@/Components/Forms/PaymentForm.vue'
import ClientDisplay from '@/Components/Forms/ClientDisplay.vue'
import PostageForm from '@/Components/Forms/PostageForm.vue'


export default {
    props:[
        'client','invoice'
    ],
    components:{
    AppLayout,
    BreezeLabel,
    BreezeButton,
    BreezeInput,
    BreezeInputError,
    Link,
    Head,
    ClientForm,
    ClientDisplay,
    ProductForm,
    SalesForm,
    PaymentForm,
    PostageForm
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
                        price : this.invoice.Price,
                        qty : this.invoice.Qty,
                        discount : this.invoice.Discount,
                        discounted_price : 0,
                        total : this.invoice.Total_RM,
                    },{
                         product:this.invoice.Product_2,
                        price : this.invoice.Price_2,
                        qty : this.invoice.Qty_2,
                        discount : this.invoice.Discount_2,
                        discounted_price : 0,
                        total : this.invoice.Total_RM_2,
                    }, {
                         product:this.invoice.Product_3,
                        price : this.invoice.Price_3,
                        qty : this.invoice.Qty_3,
                        discount : this.invoice.Discount_3,
                        discounted_price : 0,
                        total : this.invoice.Total_RM_3,
                    }, {
                         product:this.invoice.Product_4,
                        price : this.invoice.Price_4,
                        qty : this.invoice.Qty_4,
                        discount : this.invoice.Discount_4,
                        discounted_price : 0,
                        total : this.invoice.Total_RM_4,
                    }, {
                         product:this.invoice.Product_5,
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
                    consultant:"",
                    channel:"",
                    closing:""
                },
                shipping:{
                    Ship_Name:"",
                    Ship_Phone:"",
                    Ship_Add1:"",
                    Ship_Add2:"",
                    Ship_poscode:"",
                    Ship_City:"",
                    Ship_State:"",
                    Ship_Country:""
                }
            }),
        };
    },
    methods: {

        goToViewPage(data) {
            window.open(route('portfolio.invoice.show',{'invoice': data.Id}), '_self');
        },
        storeInvoice(){
            this.invoiceForm.post(route('portfolio.invoice.store'));
        },

        storeClient() {
                this.form.post(route('portfolio.client.store'),{
                    errorBag: 'storeClient',
                    preserveScroll: true,
                     onFinish: () => {
                        this.showUpdateForm = false;
                    },
                });
            },

            copyAddress(){
                this.invoiceForm.shipping.Ship_Name =  this.clientForm.Name
                this.invoiceForm.shipping.Ship_Phone =  this.clientForm.Mobile_No
                this.invoiceForm.shipping.Ship_Add1 =  this.clientForm.Address
                this.invoiceForm.shipping.Ship_Add2 =  this.clientForm.Address_2
                this.invoiceForm.shipping.Ship_poscode =  this.clientForm.Poscode
                this.invoiceForm.shipping.Ship_City =  this.clientForm.City
                this.invoiceForm.shipping.Ship_State =  this.clientForm.State
                this.invoiceForm.shipping.Ship_Country =  this.clientForm.Country
            },
             clearAddress(){
                this.invoiceForm.shipping.Ship_Name =  ""
                this.invoiceForm.shipping.Ship_Phone =  ""
                this.invoiceForm.shipping.Ship_Add1 =  ""
                this.invoiceForm.shipping.Ship_Add2 =  ""
                this.invoiceForm.shipping.Ship_poscode =  ""
                this.invoiceForm.shipping.Ship_City =  ""
                this.invoiceForm.shipping.Ship_State =  ""
                this.invoiceForm.shipping.Ship_Country =  ""
            }
    },

}

</script>

<template>
<Head title="Quick Order" />
<app-layout>
     <h1 class="mb-8 text-2xl font-bold">
      <Link class="text-primary hover:text-primary-focus" href="/invoice">Invoice</Link>
      <span class="text-primary font-medium">/</span> Quick Order
    </h1>
    <form @submit.prevent="storeInvoice" class="form">

        <div class="divider text-xl mb-8 " id="client">Client</div>
            <client-display
                :client="clientForm"
                :states="$page.props.states"
            />
        <div class="divider text-xl mb-8 mt-32 " id="postage">Postage</div>
            <div class="flex items-end justify-end my-12 gap-2">
                    <button @click="copyAddress" type="button" class="btn btn-ghost btn-sm" title="Copy Client Details">
                   <i class="bi bi-files"></i>
                   </button>

                    <button @click="clearAddress" type="button" class="btn btn-ghost btn-sm" title="Clear Postage Detail">
                  <i class="bi bi-eraser-fill"></i>
                  </button>
            </div>
            <postage-form
                :states="$page.props.states"
                :shipping="invoiceForm.shipping"
            />


        <div class="divider text-xl mb-8 mt-32 " id="product">Product</div>
            <product-form
                :products="invoiceForm.products"
                :productLists="$page.props.products" />

        <div class="divider text-xl mb-8 mt-32 " id="sales">Sales</div>
            <sales-form
                :consultants="$page.props.consultants"
                :sales="invoiceForm.sales" />

         <div class="my-12 flex justify-end">
        <breeze-button :class="{ 'opacity-25': invoiceForm.processing }" :disabled="invoiceForm.processing">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save mr-3" viewBox="0 0 16 16">
  <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
</svg>
  Save
        </breeze-button>
        </div>

    </form>
</app-layout>

</template>
