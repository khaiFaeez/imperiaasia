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
     <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-primary hover:text-primary-focus" href="/client">Client</Link>
      <span class="text-primary font-medium">/</span> {{client.Name}}
    </h1>
<section class="flex flex-row items-center justify-between mb-5">
    <div></div>
    <Link :href="route('portfolio.invoice.create',{portfolio:route().params.portfolio,client_id:client.id})" v-if="route().current('*.client.*')" class="btn btn-primary text-white">
        New Order
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
                <td><Link :href="route('portfolio.invoice.repeat',{portfolio:route().params.portfolio,invoice_id:$invoice.Id})" v-if="route().current('*.client.*')" class="btn btn-primary text-white">Repeat Order</Link></td>
  </tr>
 </tbody>
</table>

</AppLayout>

</template>
