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


export default {
    props:{
        client:Boolean
    },
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
        PaymentForm
    },
    data() {
        return {
             ClientFormv:this.$inertia.form({
                    MyKad_SSM:"",
                    Name:"",
                    Mobile_No:"",
                    Phone:"",
                    Off_Phone:"",
                    Address:"",
                    Address_2:"",
                    Poscode:"",
                    City:"",
                    State:"",
                    Country:""
            }),
            invoiceForm: this.$inertia.form({
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
                }
            }),
            canCreate:false,
            orderType:""

        };
    },
    methods: {

        goToViewPage(data) {
            window.open(route('portfolio.invoice.show',{'invoice': data.Id,'portfolio':this.$page.props.portfolio}), '_self');
        },
        storeInvoice(){
            this.invoiceForm.post(route('portfolio.invoice.store',{'portfolio':this.$page.props.portfolio}));
        },
        onSearchIDChange(event) {

        // let input =  document.querySelector('#ic_checker');
        // input.classList.remove('input-primary');
        // input.classList.remove('input-success');
        // input.classList.remove('input-error');
        // input.classList.add('input-primary');
        // let that = this;

        // this.axios.get('/livesearch', {
        //     params: {
        //     keyword: event.target.value
        //     }
        // }).then((res) => {
        //         input.classList.remove('input-primary');
        //         input.classList.add("input-success");
        //         if(Object.keys(res.data).length == 0){
        //             that.canCreate = 'client'
        //         }else{
        //             that.canCreate = 'order'
        //             that.ClientFormv = res.data
        //         }

        // }).catch( (error)=> {
        //         input.classList.remove('input-primary');
        //         input.classList.add("input-error");
        //         that.canCreate = false;
        //     })

        // this.form.get('/')
        },
    }
}

</script>
<template>
<Head title="Create Invoice" />
<AppLayout>
     <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-primary hover:text-primary-focus" href="/invoice">Invoice</Link>
      <span class="text-primary font-medium">/</span> Create
    </h1>
    <form @submit.prevent="storeInvoice" class="form">
        <div class="divider text-xl">Client</div>
        <div class="grid grid-cols-1 gap-5 mb-12">
                <div>
                  <BreezeLabel value="ID Number"/>
                  <BreezeInput  type="text" name="MyKad_SSM"  @change="onSearchIDChange($event)" id="ic_checker"/>
                </div>
                <div class="btn-group gap-3" v-show="orderType == ''">
                    <div class="btn btn-primary" v-show="canCreate=='client'" @click="orderType = 'newClient'">Create Client</div>
                    <div class="btn btn-primary" v-show="canCreate=='order'" @click="orderType = 'newOrder'">New Order</div>
                    <div class="btn btn-primary" v-show="canCreate=='order'" @click="orderType = 'order'">Repeat Order</div>
                </div>
        </div>

        <transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <div v-show="orderType == 'newClient'">
            <ClientForm :client="ClientFormv" :states="$page.props.states"/>
            </div>

     </transition>

      <transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <div v-show="orderType == 'newOrder' || orderType == 'order'" >
            <ClientDisplay  :client="ClientFormv" :states="$page.props.states"/>
             <div class="divider text-xl">Product</div>
              <ProductForm :product="invoiceForm.products" :products="$page.props.products" />
            </div>
     </transition>

            <!--<div class="divider text-xl">Sales</div>
             <SalesForm :sales="invoiceForm.sales" :consultants="$page.props.consultants" />
            <div class="divider text-xl">Payment</div>
             <PaymentForm :payment="invoiceForm.payment"/>
            <BreezeButton class="ml-4" :class="{ 'opacity-25': invoiceForm.processing }" :disabled="invoiceForm.processing">
                Submit
            </BreezeButton> -->
        <!-- <transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <div v-show="newOrder" >
            <ClientForm  :client="ClientFormv" :states="$page.props.states"/>
            </div>
     </transition> -->

    </form>
</AppLayout>

</template>
