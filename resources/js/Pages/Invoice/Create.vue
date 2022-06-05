<script>
import { Link,Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import ClientForm from '@/Components/Forms/ClientForm.vue'
import ProductForm from '@/Components/Forms/ProductForm.vue'
import SalesForm from '@/Components/Forms/SalesForm.vue'
import PaymentForm from '@/Components/Forms/PaymentForm.vue'
import ClientDisplay from '@/Components/Forms/ClientDisplay.vue'
import PostageForm from '@/Components/Forms/PostageForm.vue'
import BreezeButton from '@/Components/Button.vue'

export default {
    props:[
        'client'
    ],
    components:{
        AppLayout,
        Link,
        Head,
        ClientForm,
        ClientDisplay,
        ProductForm,
        SalesForm,
        PaymentForm,
        PostageForm,
        BreezeButton
    },
    data() {
        return {
            clientForm:this.$inertia.form({
                    id:this.client.id,
                    MyKad_SSM:this.client.MyKad_SSM,
                    Name:this.client.Name,
                    Mobile_No:this.client.Mobile_No,
                    Phone:this.client.Phone,
                    Off_Phone:this.client.Off_Phone,
                    Address:this.client.Address,
                    Address_2:this.client.Address_2,
                    Poscode:this.client.Poscode,
                    City:this.client.City,
                    State:this.client.State,
                    Country:this.client.Country
            }),
            invoiceForm: this.$inertia.form({
                client:this.client.id,
                products:{
                grand_total:0,
                items:[
                    {
                        product:"",
                        price : 0,
                        qty : 0,
                        discount : 0,
                        discounted_price : 0,
                        total : 0,
                    },{
                        product:"",
                        price : 0,
                        qty : 0,
                        discount : 0,
                        discounted_price : 0,
                        total : 0,
                    }, {
                        product:"",
                        price : 0,
                        qty : 0,
                        discount : 0,
                        discounted_price : 0,
                        total : 0,
                    }, {
                        product:"",
                        price : 0,
                        qty : 0,
                        discount : 0,
                        discounted_price : 0,
                        total : 0,
                    }, {
                        product:"",
                        price : 0,
                        qty : 0,
                        discount : 0,
                        discounted_price : 0,
                        total : 0,
                    },{
                        product:"",
                        price : 0,
                        qty : 0,
                        discount : 0,
                        discounted_price : 0,
                        total : 0,
                    },{
                        product:"",
                        price : 0,
                        qty : 0,
                        discount : 0,
                        discounted_price : 0,
                        total : 0,
                    },{
                        product:"",
                        price : 0,
                        qty : 0,
                        discount : 0,
                        discounted_price : 0,
                        total : 0,
                    }
                ]},
                payment:{
                    total_settlement:"",
                   items:[
                    {
                        ptp:"",
                        settlement:0
                    }, {
                        ptp:"",
                        settlement:0
                    }, {
                        ptp:"",
                        settlement:0
                    }, {
                        ptp:"",
                        settlement:0
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
<Head title="Create Invoice" />
<AppLayout>

     <h1 class="mb-8 text-2xl font-bold flex gap-2 items-center">
      <Link class="text-primary hover:text-primary-focus" href="/invoice">Invoice</Link>
      <span class="text-primary font-medium">/</span> Create
    </h1>

    <form @submit.prevent="storeInvoice" class="form">
        <div class="flex items-center justify-end ">
                <BreezeButton :class="{ 'loading': invoiceForm.processing }" :disabled="invoiceForm.processing">
                    <i class="bi bi-save mr-3"></i>
                        Save
                </BreezeButton>
            </div>
            <div class="grid grid-cols-1 xl:grid-cols-1 gap-4">
            <div class="my-3">
            <div class="divider text-xl" id="client">Client</div>
            <client-display
                :client="clientForm"
                :states="$page.props.states"
            />
            </div>

            <div class="my-3">
            <div class="divider text-xl" id="postage">Postage</div>
            <div class="flex items-end justify-end gap-2">
                    <button @click="copyAddress" type="button" class="btn btn-ghost btn-sm" title="Copy Client Details">
                   <i class="bi bi-files"></i>
                    </button>

                    <button @click="clearAddress" type="button" class="btn btn-ghost btn-sm" title="Clear Postage Detail">
                  <i class="bi bi-eraser-fill"></i></button>
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
                :productLists="$page.props.products" />
            </div>

            <div class="my-3">
            <div class="divider text-xl" id="sales">Sales</div>
                <sales-form
                    :consultants="$page.props.consultants"
                    :sales="invoiceForm.sales" />
            </div>

            <div class="my-3">
            <div class="divider text-xl" id="sales">Payment</div>
                <payment-form
                    :payment="invoiceForm.payment" />
            </div>
        </div>
    </form>
</AppLayout>

</template>
