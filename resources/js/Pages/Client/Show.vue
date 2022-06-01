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
<div class="alert alert-error shadow-lg mb-5" v-show="client.invoices.find(o => o.Status_Inv === 'PENDING')">
  <div>
    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
    <span>This client have pending invoice</span>
  </div>
</div>
<div class="flex flex-row justify-end mb-5">
    <Link :href="route('portfolio.invoice.create',{portfolio:route().params.portfolio,client_id:client.id})"  class="btn btn-primary" v-if="!client.invoices.find(o => o.Status_Inv === 'PENDING')">
   <i class="bi bi-stars mr-3"></i>
        New Invoice
    </Link>
    <Link class="btn btn-primary btn-disabled" v-else>
   <i class="bi bi-stars mr-3"></i>
        New Invoice
    </Link>
</div>
            <ClientDisplay class="mb-12" :client="client" :states="$page.props.states"/>

           <table class="table table-compact table-bordered w-full">
<thead>
 <tr>
    <th>Status</th>
    <th>Inv No</th>
    <th>Aging</th>
    <th>Date</th>
    <th></th>
 </tr>
 </thead>
 <tbody>
  <tr  v-for="$invoice in $page.props.client.invoices" :key="$invoice.Id" >


                <td><div class="badge text-white" :class='$invoice.Status_Inv == "PAID" ? "badge-success " : "badge-error"'> {{$invoice.Status_Inv}}</div></td>
                <td>{{ $invoice.Inv_No }}</td>
                 <td>{{ $invoice.Date ? moment(moment().subtract($invoice.Aging, 'days')).endOf('day').fromNow() : "" }}</td>
                <td>{{ $invoice.Date ? moment($invoice.Date).format('DD/MM/YYYY') : "" }}</td>
                <td v-if="!client.invoices.find(o => o.Status_Inv === 'PENDING')">
                    <Link :href="route('portfolio.invoice.repeat',{portfolio:route().params.portfolio,invoice_id:$invoice.Id})" class="btn btn-primary btn-sm" >
                    <i class="bi bi-arrow-repeat mr-3"></i>
                    Quick Order
                    </Link>
                </td>
                <td v-else>
                    <Link  class="btn btn-primary btn-sm btn-disabled" >
                    <i class="bi bi-arrow-repeat mr-3"></i>
                    Quick Order
                    </Link>
                </td>
  </tr>
 </tbody>
</table>

</AppLayout>

</template>
