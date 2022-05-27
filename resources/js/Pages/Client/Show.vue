<script>
import { Link,Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import ClientDisplay from '@/Components/Forms/ClientDisplay.vue'
import moment from 'moment'


export default {
    props:[
        'client','states'
    ],
    components:{
        AppLayout,
        Link,
        Head,
        ClientDisplay,
    },
    created: function () {
        this.moment = moment;
    },
}

</script>
<template>
<Head title="View Client" />
<AppLayout>
     <h1 class="mb-8 text-2xl font-bold">
      <Link class="text-primary hover:text-primary-focus" href="/client">Client</Link>
      <span class="text-primary font-medium">/</span> {{client.Name}}
    </h1>
<section class="flex flex-row items-center justify-between mb-5">
    <div></div>
    <Link :href="route('portfolio.invoice.create',{portfolio:route().params.portfolio,client_id:client.id})" v-if="route().current('*.client.*')" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
    </svg>
        New Invoice
    </Link>


</section>
            <ClientDisplay  :client="client" :states="$page.props.states"/>

           <table class="table table-compact table-bordered w-full">
<thead>
 <tr>
    <th>Status</th>
    <th>Inv No</th>

    <th>Product</th>
    <th>U/Price</th>
    <th>Qty</th>
    <th>Total</th>
    <th></th>
 </tr>
 </thead>
 <tbody>
  <tr class="hover hover:cursor-pointer" v-for="$invoice in $page.props.client.invoices" :key="$invoice.Id" @click="goToViewPage($invoice)">


                <td>{{ $invoice.Status_Inv}}</td>
                <td>{{ $invoice.Inv_No }}</td>

                <td>{{ $invoice.product?.Product_Name}}</td>
                <td>{{ $invoice.Price }}</td>
                <td>{{ $invoice.Qty }}</td>
                <td>{{ $invoice.Total_RM }}</td>
                <td><Link :href="route('portfolio.invoice.repeat',{portfolio:route().params.portfolio,invoice_id:$invoice.Id})" v-if="route().current('*.client.*')" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                    </svg>
                    Quick Order</Link></td>
  </tr>
 </tbody>
</table>

</AppLayout>

</template>
