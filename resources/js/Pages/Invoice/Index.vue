<script>
import { ref } from 'vue';
import { Link,Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination'
import moment from 'moment'
import BreezeInput from '@/Components/Input.vue'
import SearchFilter from '@/Components/SearchFilter'
import throttle from 'lodash/throttle'
import pickBy from 'lodash/pickBy'

const showingNavigationDropdown = ref(false);


export default {
    props:[
        'invoice','filters'
    ],
     data() {
        return {
        form: {
            search: this.filters.search,
        },
        }
    },
     watch: {
        form: {
        deep: true,
        handler: throttle(function () {
            this.$inertia.get(route('portfolio.invoice.index'), pickBy(this.form), { preserveState: true })
        }, 150),
        },
    },
    components:{
        Pagination,
        AppLayout,
        Head,
        Link,
        SearchFilter,
    },
    created: function () {
        this.moment = moment;
    },
    methods: {
        goToViewPage(data) {
            window.open(route('portfolio.invoice.show',{'invoice': data.Id}), '_self');
        },
         reset() {
            this.form = {
            search: null,
            }
         }
    }
}
</script>

<template>
<Head title="Invoice List" />
<AppLayout>
<h1 class="mb-8 text-2xl font-bold">
    <Link class="text-primary hover:text-primary-focus" href="/invoice">Invoice</Link>
</h1>


<div class="flex flex-row items-center justify-between">
    <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
      </search-filter>

       <Link :href="route('portfolio.client.create')" class="btn btn-primary hidden" >
       <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
        </svg>
       Quick Order
        </Link>
</div>
<div class="overflow-auto my-5">
<table class="table table-compact table-bordered w-full">
<thead>
 <tr>
    <th>Status</th>
    <th>Aging</th>
    <th>Inv No</th>
    <th>Date</th>
    <th>ID Card</th>
    <th>Name</th>
    <th>Ship Phone</th>
    <th>Ship Name</th>
    <th>Ship Address 1</th>
    <th>Ship Address 2</th>
    <th>Ship Postcode</th>
    <th>Ship City</th>
    <th>Ship State</th>
    <th>Ship Country</th>

    <th>Product</th>
    <th>U/Price</th>
    <th>Qty</th>
    <th>Total</th>

    <th>Grand Total</th>
    <th>Paid Total</th>
    <th>Overdue Amount</th>
    <th>Consultant</th>
    <th>Channel</th>

    <th>PTP 1</th>
    <th>PTP 2</th>
    <th>PTP 3</th>
    <th>PTP 4</th>

    <th>Created By</th>
    <th>Created Date</th>
 </tr>
 </thead>
 <tbody>
  <tr class="hover hover:cursor-pointer" v-for="$invoice in $page.props.invoices.data" :key="$invoice.Id" @click="goToViewPage($invoice)">
                <td><div class="badge text-white" :class='$invoice.Status_Inv == "PAID" ? "badge-success " : "badge-error"'> {{$invoice.Status_Inv}}</div></td>
                <td>{{ $invoice.Aging}} Days</td>
                <td>{{ $invoice.Inv_No }}</td>
                <td>{{ $invoice.Date ? moment($invoice.Date).format('LL') : "" }}</td>
                <td>{{ $invoice.client.MyKad_SSM }}</td>
                <td>{{ $invoice.client.Name }}</td>
                <td>{{ $invoice.Ship_Phone }}</td>
                <td>{{ $invoice.Ship_Name }}</td>
                <td>{{ $invoice.Ship_Add1 }}</td>
                <td>{{ $invoice.Ship_Add2 }}</td>
                <td>{{ $invoice.Ship_poscode }}</td>
                <td>{{ $invoice.Ship_City }}</td>
                <td>{{ $invoice.state?.Negeri}}</td>
                <td>{{ $invoice.Ship_Country }}</td>

                <td>{{ $invoice.product?.Product_Name}}</td>
                <td>{{ $invoice.Price }}</td>
                <td>{{ $invoice.Qty }}</td>
                <td>{{ $invoice.Total_RM }}</td>

                <td>Grand Total</td>
                <td>Paid Total</td>
                <td>Overdue Amount</td>
                <td>{{$invoice.consultant.Name}}</td>
                <td>{{$invoice.channel?.Name}}</td>

                <td>{{  $invoice.Promise_pay1 ? moment($invoice.Promise_pay1).format('LL') : ""}}</td>
                <td>{{  $invoice.Promise_pay2 ? moment($invoice.Promise_pay2).format('LL') : ""}}</td>
                <td>{{  $invoice.Promise_pay3 ? moment($invoice.Promise_pay3).format('LL') : ""}}</td>
                <td>{{  $invoice.Promise_pay4 ? moment($invoice.Promise_pay4).format('LL') : ""}}</td>

                <td>{{ $invoice.Created_By }}</td>
                <td>{{ $invoice.Created_Date ? moment($invoice.Created_Date).format('LL') :  ""}}</td>
  </tr>
 </tbody>
</table>
</div>
<pagination class="mt-6" :links="$page.props.invoices.links" />
</AppLayout>

</template>
