<script>
import { Link,Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeInputError from  '@/Components/InputError.vue'
import ClientDisplay from '@/Components/Forms/ClientDisplay.vue'
import ProductForm from '@/Components/Forms/ProductForm.vue'
import SalesForm from '@/Components/Forms/SalesForm.vue'
import PaymentForm from '@/Components/Forms/PaymentForm.vue'


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
        ProductForm,
        SalesForm,
        PaymentForm
    },
    methods: {

        goToViewPage(data) {
            window.open(route('portfolio.invoice.show',{'invoice': data.Id,'portfolio':this.$page.props.portfolio}), '_self');
        },
        openPDF(data){
            window.open(route('portfolio.invoice.pdf',{'invoice': data.Id,'portfolio':this.$page.props.portfolio}), '_blank')
        }
    }
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
    <button @click="openPDF(invoice)" class="btn btn-info" >PDF</button>
</section>
        <div class="divider text-xl">Client</div>
      <transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <div >
            <ClientDisplay  :client="invoice.client" :states="$page.props.states"/>
            <div class="divider text-xl">Product</div>
             <!-- <ProductForm :product="invoice.products" :products="$page.props.products" :readonly="true"/>
            <div class="divider text-xl">Sales</div>
             <SalesForm :sales="invoice.sales" :consultants="$page.props.consultants" />
            <div class="divider text-xl">Payment</div>
             <PaymentForm :payment="invoice.payment"/>
            <BreezeButton class="ml-4" :class="{ 'opacity-25': invoice.processing }" :disabled="invoice.processing">
                Submit
            </BreezeButton> -->
            </div>
     </transition>

</AppLayout>

</template>
